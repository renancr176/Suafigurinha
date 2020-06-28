<?php

use Illuminate\Support\Facades\Route;

$guidRegex = '(\{){0,1}[0-9a-fA-F]{8}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{12}(\}){0,1}';
$intRegex = '\d+';

Route::any('/', ['as' => 'home', function () {
    return redirect(env('BASE_SITE'));
}]);

include('web/admin.php');
include('web/home.php');