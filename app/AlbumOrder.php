<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumOrder extends Model
{

    public function client()
    {
        return $this->hasOne('App\AlbumOrderClientData');
    }

    public function delivery_address()
    {
        return $this->hasOne('App\AlbumOrderDeliveryAddress');
    }
}
