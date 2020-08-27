<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\MakeAlbumService;
use App\Services\MakePdfAlbumService;
use App\Services\MakePdfAlbumFiguresGirdService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MakeAlbumService::class, function($app)
        {
            return new MakeAlbumService();
        });

        $this->app->bind(MakePdfAlbumService::class, function($app)
        {
            return new MakePdfAlbumService();
        });

        $this->app->bind(MakePdfAlbumFiguresGirdService::class, function($app)
        {
            return new MakePdfAlbumFiguresGirdService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }
}
