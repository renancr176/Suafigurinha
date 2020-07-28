<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumFrameType extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function font()
    {
        return $this->belongsTo('App\Font');
    }
}
