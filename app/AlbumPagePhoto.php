<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumPagePhoto extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function page()
    {
        return $this->belongsTo('App\AlbumPage');
    }

    public function frameType()
    {
        return $this->belongsTo('App\AlbumFrameType', 'album_frame_type_id');
    }
}
