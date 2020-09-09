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

    public function presentationCoverPageType()
    {
        return $this->belongsTo('App\PageType', 'presentation_cover_page_type_id');
    }

    public function printCoverPageType()
    {
        return $this->belongsTo('App\PageType', 'print_cover_page_type_id');
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
