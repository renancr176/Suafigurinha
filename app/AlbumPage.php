<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumPage extends Model
{
    public function album()
    {
        return $this->belongsTo('App\Album');
    }

    public function photos()
    {
        return $this->hasMany('App\AlbumPagePhoto');
    }

    public function texts()
    {
        return $this->hasMany('App\AlbumPageText');
    }

    public function backgrounds()
    {
        return $this->hasMany('App\AlbumPageBackground');
    }
}
