<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function pageType()
    {
        return $this->belongsTo('App\PageType');
    }

    public function pages()
    {
        return $this->hasMany('App\AlbumPage');
    }

    public function orders()
    {
        return $this->hasMany('App\AlbumOrder');
    }
}
