<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumOrderText extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function albumPage()
    {
        return $this->belongsTo('App\AlbumPage');
    }

    public function albumPageText()
    {
        return $this->belongsTo('App\AlbumPageText');
    }
}
