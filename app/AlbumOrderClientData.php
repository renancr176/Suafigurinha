<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumOrderClientData extends Model
{
    protected $primaryKey = 'album_order_id';

    public function order()
    {
        return $this->belongsTo('App\AlbumOrder');
    }
}
