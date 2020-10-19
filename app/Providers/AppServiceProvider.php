<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\MakeAlbumService;
use App\Services\MakePdfAlbumService;
use App\Services\MakePdfAlbumFiguresGirdService;
use App\Services\SendEmailToStaffService;
use App\Services\MakePdfAlbumCoverService;
use App\Services\WixWebHookService;

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

        $this->app->bind(MakePdfAlbumCoverService::class, function($app)
        {
            return new MakePdfAlbumCoverService();
        });

        $this->app->bind(SendEmailToStaffService::class, function($app)
        {
            return new SendEmailToStaffService();
        });

        $this->app->bind(WixWebHookService::class, function($app)
        {
            return new WixWebHookService();
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
