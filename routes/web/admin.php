<?php

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Web\Admin',
        'middleware' => ['auth']
    ],
    function () {

        Route::get('/', ['as' => 'admin', function () {
            return view('admin.index');
        }]);

        Route::resource('album', 'AlbumController');
    }
);
