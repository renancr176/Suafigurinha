<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumOrderClientData extends Model
{
    protected $primaryKey = 'album_order_id';

    protected $guarded = ['album_order_id', 'created_at', 'updated_at'];

    public static $rules = [
        'client_name' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required'
    ];

    public function order()
    {
        return $this->belongsTo('App\AlbumOrder');
    }
}
