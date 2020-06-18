<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(env('BASE_SITE'));
});

include('web/admin.php');
include('web/home.php');