<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(
    [
        'namespace' => 'Api',
        //'middleware' => 'api',
        'prefix' => 'auth'
    ],
    function () {
        Route::post('login', 'AuthController@login');
        //Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('user-profile', 'AuthController@userProfile');
    }
);

Route::group(
    [
        'namespace' => 'Api',
        'middleware' => 'api'
    ],
    function () {
        Route::apiResource('album', 'AlbumController')
            ->only(['show']);

        Route::apiResource('album-order', 'AlbumOrderController')
            ->only(['store']);

        Route::apiResource('my-album', 'MyAlbumController')
            ->only(['update']);
    }
);

