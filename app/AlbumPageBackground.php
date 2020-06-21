<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumPageBackground extends Model
{
    public function page()
    {
        return $this->belongsTo('App\AlbumPage');
    }
}
