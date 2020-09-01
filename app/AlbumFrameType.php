<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumFrameType extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function printPageType()
    {
        return $this->belongsTo('App\PageType', 'print_page_type_id');
    }

    public function font()
    {
        return $this->belongsTo('App\Font');
    }
}
