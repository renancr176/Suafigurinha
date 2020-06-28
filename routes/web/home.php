<?php

Route::get(
    'meu-album/{id}', 
    [
        'as' => 'meu-album', 
        'uses' => 'Home\MeuAlbumController@Get'
    ]
)->where('id', $guidRegex);

// Route::group(['namespace' => 'Home'], 
// function () {
//     Route::controller(
//         '', 
//         'MeuAlbumController',
//         [
//             'Get' => 'meu-album/{id}'
//         ]
//     );
// });
