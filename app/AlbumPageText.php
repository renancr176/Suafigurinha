<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumPageText extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function page()
    {
        return $this->belongsTo('App\AlbumPage');
    }

    public function font()
    {
        return $this->belongsTo('App\Font');
    }
}
