<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumCover extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public function albumPage()
    {
        return $this->belongsTo('App\AlbumPage');
    }

    public function albumCoverType()
    {
        return $this->belongsTo('App\AlbumCoverType');
    }
}
