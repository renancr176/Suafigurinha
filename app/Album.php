<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function presentationPageType()
    {
        return $this->belongsTo('App\PageType', 'presentation_page_type_id');
    }

    public function printPageType()
    {
        return $this->belongsTo('App\PageType', 'print_page_type_id');
    }

    public function printBackFrontPageType()
    {
        return $this->belongsTo('App\PageType', 'print_back_front_page_type_id');
    }

    public function frameType()
    {
        return $this->belongsTo('App\AlbumFrameType', 'album_frame_type_id');
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
