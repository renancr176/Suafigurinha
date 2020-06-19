<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeuAlbumController extends Controller
{
    public function Get($id)
    {
        return view('home.meu-album');
    }
}
