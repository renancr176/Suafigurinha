<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumPageBackground extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function page()
    {
        return $this->belongsTo('App\AlbumPage');
    }
}
