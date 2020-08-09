<?php

Route::group(
    [
        'namespace' => 'Web\Home'
    ],
    function () {

        Route::resource('meu-album', 'MyAlbumController')
            ->only(['show', 'update']);

        Route::get('meu-album/sucesso/{id}', ['as' => 'meu-album.sucesso', function($id)
        {
            $order = App\AlbumOrder::where('transaction_id', $id)
            ->where('completed', true)
            ->firstOrFail();
    
            return view('home.my-album.success');
        }]);

        Route::get('my-album-pages/{id}', 'MyAlbumPdfController@getPagesPdf');
        Route::get('my-album-grid/{id}', 'MyAlbumPdfController@getGridPdf');
        Route::get('my-album-image/{id}/{imageId}', 'MyAlbumPdfController@getImage');
    }
);
