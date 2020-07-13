<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumOrderDeliveryAddress extends Model
{
    protected $primaryKey = 'album_order_id';

    protected $guarded = ['album_order_id', 'created_at', 'updated_at'];

    public static $rules = [
        'zipcode' => 'required',
        'state' => 'required',
        'city' => 'required',
        'district' => 'required',
        'address' => 'required',
        'address_number' => 'required',
        'receiver_name' => 'required'
    ];

    public function order()
    {
        return $this->belongsTo('App\AlbumOrder');
    }
}
