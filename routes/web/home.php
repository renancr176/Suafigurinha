<?php

Route::group(
    [
        'namespace' => 'Web\Home'
    ],
    function () {

        Route::resource('meu-album', 'MyAlbumController')
            ->only(['show', 'update']);

        Route::get('my-album-pages/{id}', 'MyAlbumPdfController@getPagesPdf');
        Route::get('my-album-grid/{id}', 'MyAlbumPdfController@getGridPdf');
    }
);
