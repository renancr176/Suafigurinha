<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumPagePhoto extends Model
{
    public function page()
    {
        return $this->belongsTo('App\AlbumPage');
    }

    public function frameType()
    {
        return $this->belongsTo('App\AlbumFrameType');
    }
}
