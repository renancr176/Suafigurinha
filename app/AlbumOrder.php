<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumOrder extends Model
{
    public function album()
    {
        return $this->belongsTo('App\Album');
    }

    public function client()
    {
        return $this->hasOne('App\AlbumOrderClientData');
    }

    public function delivery_address()
    {
        return $this->hasOne('App\AlbumOrderDeliveryAddress');
    }
}
