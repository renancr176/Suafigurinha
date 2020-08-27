<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MyAlbumRequest;
use App\AlbumOrder;
use App\Enums\AlbumOrderFileTypeEnum;
use App\Events\AlbumDataSentByClientEvent;

class MakeAlbumService
{
    public function requestIsValid(MyAlbumRequest $request, AlbumOrder $order)
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

        foreach ($album->pages as $page)
        {
            foreach ($page->texts as $text)
            {
                if ($request->texts == null
                || !array_key_exists($page->id, $request->texts)
                || !array_key_exists($text->id, $request->texts[$page->id])
                || strlen(trim($request->texts[$page->id][$text->id])) == 0)
                {
                    return false;
                }
            }

            foreach ($page->photos as $photo)
            {
                if ($request->photo == null
                || !array_key_exists($page->id, $request->photo)
                || !array_key_exists($photo->id, $request->photo[$page->id]))
                {
                    return false;
                }
            }

            foreach ($page->backgrounds as $background)
            {
                if ($request->background == null
                || !array_key_exists($page->id, $request->background)
                || !array_key_exists($background->id, $request->background[$page->id]))
                {
                    return false;
                }
            }
        }

        return true;
    }

    public function make(MyAlbumRequest $request, AlbumOrder $order)
    {
        if(!$this->requestIsValid($request, $order))
            throw new Exception("Invalid request.");

        try
        {
            DB::beginTransaction();

            $files = $this->makeAlbum($request, $order);

            $order->files()->delete();
            $order->texts()->delete();

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
            
            foreach ($files as $file)
                $order->files()->create($file);
            
            if ($request->has('texts'))
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

        AlbumDataSentByClientEvent::dispatch($order);
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

        $baseDir = "album_orders/$order->transaction_id";

        if(Storage::disk(env('STORAGE', 'local'))->exists($baseDir))
            Storage::disk(env('STORAGE', 'local'))->deleteDirectory($baseDir);

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
            Storage::disk(env('STORAGE', 'local'))->put($fileName, $content);
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
            Storage::disk(env('STORAGE', 'local'))->delete($file['path']);
        }
    }
}
