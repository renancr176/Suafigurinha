<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumPageText extends Model
{
    public function page()
    {
        return $this->belongsTo('App\AlbumPage');
    }

    public function font()
    {
        return $this->belongsTo('App\Font');
    }
}
