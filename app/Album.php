<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function pageType()
    {
        return $this->belongsTo('App\PageType');
    }

    public function pages()
    {
        return $this->hasMany('App\AlbumPage');
    }
}
