<?php

Route::group(
    [
        'namespace' => 'Web\Home'
    ],
    function () {

        Route::resource('meu-album', 'MyAlbumController')
            ->only(['show', 'update']);
    }
);
