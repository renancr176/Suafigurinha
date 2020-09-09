<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumPage extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function album()
    {
        return $this->belongsTo('App\Album');
    }

    public function albumCover()
    {
        return $this->hasOne('App\AlbumCover', 'album_page_id');
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
