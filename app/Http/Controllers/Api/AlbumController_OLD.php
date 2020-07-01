<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Album;

class AlbumController extends Controller
{
    /**
     * Get.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $album = Album::with([
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
        ])->find($id);
        return $album;
    }
}
