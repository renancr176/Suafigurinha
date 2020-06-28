<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;

class MeuAlbumController extends Controller
{
    public function Get($id)
    {
        $order = App\AlbumOrder::where('transaction_id', $id)->firstOrFail();

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

        return view('home.meu-album');
    }
}
