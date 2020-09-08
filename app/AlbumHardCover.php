<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumHardCover extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function album()
    {
        return $this->belongsTo('App\Album');
    }

    public function albumCoverType()
    {
        return $this->belongsTo('App\AlbumCoverType');
    }
}
