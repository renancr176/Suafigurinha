<?php

Route::get('meu-album/{id}', function ($id) {
    return "Balbum $id";
})->where('id', '\d');