<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MyAlbumRequest;
use App\AlbumOrder;
use App\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;
use App\Enums\AlbumOrderFileTypeEnum;
//use App\Events\AlbumDataSentByClientEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailFaild;
use App\Mail\AlbumCreatedByClient;
use App\Mail\AlbumCreatedClientConfirmation;

class MyAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(env('BASE_SITE'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect(env('BASE_SITE'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect(env('BASE_SITE'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = AlbumOrder::where('transaction_id', $id)
        ->where('completed', false)
        ->firstOrFail();

        $album = $order->album()->with([
            'pageType',
            'frameType',
            'pages' => function($query){
                $query->orderBy('sequence');
            },
            'pages.photos' => function($query){
                $query->orderBy('sequence');
            },
            'pages.texts',
            'pages.backgrounds'
        ])->firstOrFail();

        $fonts = array();
        foreach($album->pages()->get() as $page)
            foreach($page->texts()->get() as $text)
                array_push($fonts, $text->font);

        $states = State::get();

        return view('home.my-album.index', compact('order', 'album', 'fonts', 'states'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect(env('BASE_SITE'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MyAlbumRequest $request, $id)
    {
        $order = AlbumOrder::where('transaction_id', $id)
        ->where('completed', false)
        ->firstOrFail();

        try
        {
            DB::beginTransaction();

            $files = $this->makeAlbum($request, $order);

            $order->client()->updateOrCreate([
                'client_name' => $request->client_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number
            ]);

            $order->deliveryAddress()->updateOrCreate([
                'zipcode' => $request->zipcode,
                'state' => $request->state,
                'city' => $request->city,
                'district' => $request->district,
                'address' => $request->address,
                'address_number' => $request->address_number,
                'complement' => $request->complement,
                'receiver_name' => $request->receiver_name
            ]);

            $order->files()->delete();
            foreach ($files as $file)
                $order->files()->create($file);

            $order->texts()->delete();
            foreach ($request->texts as $pageId => $texts)
                foreach ($texts as $textId => $text)
                    $order->texts()->create([
                        'text' => $text,
                        'album_page_id' => $pageId,
                        'album_page_text_id' => $textId
                    ]);

            $order->update([
                'completed' => true
            ]);

            DB::commit();
        }
        catch (Exception $e)
        {
            $this->deleteFiles($files);

            DB::rollBack();

            throw $e;
        }

        //AlbumDataSentByClientEvent::dispatch($order);

        $this->sendStaffEmail($order);

        return redirect()->route('meu-album.sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect(env('BASE_SITE'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, $id)
    {
        return dd($request::all());
    }

    private function makeAlbum(MyAlbumRequest $request, AlbumOrder $order)
    {
        $album = $order->album()->with([
            'pageType',
            'frameType',
            'pages' => function($query){
                $query->orderBy('sequence');
            },
            'pages.photos' => function($query){
                $query->orderBy('sequence');
            },
            'pages.texts',
            'pages.texts.font',
            'pages.backgrounds'
        ])->firstOrFail();

        #region Validations
        foreach ($album->pages as $page)
        {
            foreach ($page->texts as $text)
            {
                if ($request->texts == null
                || !array_key_exists($page->id, $request->texts)
                || !array_key_exists($text->id, $request->texts[$page->id])
                || strlen(trim($request->texts[$page->id][$text->id])) == 0)
                {
                    return response(null, 400);
                }
            }

            foreach ($page->photos as $photo)
            {
                if ($request->photo == null
                || !array_key_exists($page->id, $request->photo)
                || !array_key_exists($photo->id, $request->photo[$page->id]))
                {
                    return response(null, 400);
                }
            }

            foreach ($page->backgrounds as $background)
            {
                if ($request->background == null
                || !array_key_exists($page->id, $request->background)
                || !array_key_exists($background->id, $request->background[$page->id]))
                {
                    return response(null, 400);
                }
            }
        }
        #endregion

        $baseDir = "album_orders/$order->transaction_id";

        $files = [];

        try
        {
            foreach ($album->pages as $page)
            {
                foreach ($page->photos as $photo)
                {
                    $file = [];
                    $file['album_order_file_type_id'] = AlbumOrderFileTypeEnum::Figure;
                    $file['sequence'] = $photo->sequence;
                    $file['path'] = $this->generateImageFile($request->photo[$page->id][$photo->id], $baseDir, "figurinha-$photo->sequence");
                    array_push($files, $file);
                }

                foreach ($page->backgrounds as $background)
                {
                    $file = [];
                    $file['album_order_file_type_id'] = AlbumOrderFileTypeEnum::Background;
                    $file['sequence'] = $background->sequence;
                    $file['path'] = $this->generateImageFile($request->background[$page->id][$background->id], $baseDir, "fundo-$background->sequence-pagina-$page->sequence");
                    array_push($files, $file);
                }
            }
        }
        catch (Exception $e)
        {
            $this->deleteFiles($files);

            $files = [];

            throw $e;
        }

        return $files;
    }

    private function generateImageFile($base64Image, $path, $imageName, $useStorage = true)
    {
        $imageType = $this->getImageType($base64Image);
        $base64Image = explode(',', $base64Image)[1];

        switch($imageType)
        {
            case 'image/png':
                $imageName .= '.png';
                break;
            case 'image/jpeg':
            default:
                $imageName .= '.jpg';
                break;
        }

        $content = base64_decode($base64Image);
        $fileName = "$path/$imageName";
        if($useStorage)
            Storage::disk('local')->put($fileName, $content);
        else
            file_put_contents($fileName, $content);
        return $fileName;
    }

    private function getImageType($base64Image)
    {
        return explode(':', explode(';', explode(',', $base64Image)[0])[0])[1];
    }

    private function deleteFiles(array $files)
    {
        foreach($files as $file)
        {
            Storage::disk('local')->delete($file['path']);
        }
    }

    private function sendStaffEmail(AlbumOrder $order)
    {
        $emails = array_filter(array_map(function($value){
            if(filter_var($value, FILTER_VALIDATE_EMAIL))
                return $value;

            return null;
        },
        explode(';', env('ALBUM_MAIL_TEAM'))));

        if (count($emails) > 0)
        {
            foreach ($emails as $email)
            {
                Mail::to($email)->send(new AlbumCreatedByClient($order, false));
            }

            $order->update([
                'album_email_sent' => true
            ]);
        }
        else
        {
            Mail::to(env('MAIL_USERNAME', 'renancr176@gmail.com'))
            ->send(new SendMailFaild(['Não está configurado o parâmetro ALBUM_MAIL_TEAM no arquivo .env ou não há emails definido para esta chave.']));
        }

        $this->sendEmailConfirmationToClient($order);
    }

    private function sendEmailConfirmationToClient(AlbumOrder $order)
    {
        Mail::to($order->client()->first()->email)
        ->send(new AlbumCreatedClientConfirmation($order));

        $order->update([
            'confirmation_email_sent' => true
        ]);
    }
}
