<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumCoverType extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function covers()
    {
        return $this->hasMany('App\AlbumCover');
    }
}
