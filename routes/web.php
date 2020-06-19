<?php

use Illuminate\Support\Facades\Route;

Route::any('/', ['as' => 'home', function () {
    return redirect(env('BASE_SITE'));
}]);

include('web/admin.php');
include('web/home.php');