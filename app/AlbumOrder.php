<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumOrder extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static $rules = [
        'album_id' => 'required'
    ];

    public function album()
    {
        return $this->belongsTo('App\Album');
    }

    public function client()
    {
        return $this->hasOne('App\AlbumOrderClientData');
    }

    public function deliveryAddress()
    {
        return $this->hasOne('App\AlbumOrderDeliveryAddress');
    }

    public function files()
    {
        return $this->hasMany('App\AlbumOrderFile');
    }

    public function texts()
    {
        return $this->hasMany('App\AlbumOrderText');
    }
}
