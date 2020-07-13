<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\MyAlbumRequest;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;
use App\AlbumOrder;

class MyAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MyAlbumRequest $request, $id)
    {
        return $this->makeAlbum($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function makeAlbum(MyAlbumRequest $request, $id)
    {
        $order = AlbumOrder::where('transaction_id', $id)
        ->where('completed', false)
        ->firstOrFail();

        $album = $order->album()->with([
            'pageType',
            'pages' => function($query){
                $query->orderBy('sequence');
            },
            'pages.photos' => function($query){
                $query->orderBy('sequence');
            },
            'pages.photos.frameType',
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
                || !array_key_exists($text->id, $request->texts[$page->id]))
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

        $tempDir = sys_get_temp_dir();
        $baseDir = "client_album/$id";

        $files = [];

        foreach ($album->pages as $page)
        {
            foreach ($page->photos as $photo)
            {
                $guid = Uuid::uuid1()->toString();

                array_push($files, $this->generateImage($request->photo[$page->id][$photo->id], $baseDir, $guid));
            }

            // foreach ($page->texts as $text)
            // {
            // }


            // foreach ($page->backgrounds as $background)
            // {
            // }
        }

        return $files;
    }

    private function generateImage($base64Image, $storePath, $imageName)
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
        $fileName = "$storePath/$imageName";
        Storage::disk('local')->put($fileName, $content);
        return $fileName;
    }

    private function getImageType($base64Image)
    {
        return $imageType = explode(':', explode(';', explode(',', $base64Image)[0])[0])[1];
    }
}
