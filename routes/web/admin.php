<?php

Route::group(['prefix' => 'admin'], function () {
    
    Route::get('/', ['as' => 'admin', function () {
        return view('admin.index');
    }]);

    Route::group(['prefix' => 'album'], function () {
        Route::get('/', ['as' => 'admin.album', function () {
            return '';
        }]);

        Route::get('inserir', ['as' => 'admin.album.inserir', function () {
            return '';
        }]);

        Route::post('inserir', ['as' => 'admin.album.inserir.post', function () {
            return '';
        }]);

        Route::get('datalhes/{id}', ['as' => 'admin.album.detalhes', function ($id) {
            return '';
        }])->where('id', '\d+');

        Route::get('alterar/{id}', ['as' => 'admin.album.alterar', function ($id) {
            return '';
        }])->where('id', '\d+');

        Route::post('alterar/{id}', ['as' => 'admin.album.aterar.post', function ($id) {
            return '';
        }])->where('id', '\d+');
    });

});