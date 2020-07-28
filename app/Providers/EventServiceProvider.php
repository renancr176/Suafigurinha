<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\AlbumDataSentByClientEvent;
use App\EventHandlers\AlbumDataSentByClientEventHandler;
use App\Events\ClientAlbumCreatedEvent;
use App\EventHandlers\ClientAlbumCreatedEventHandler;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AlbumDataSentByClientEvent::class => [
            AlbumDataSentByClientEventHandler::class
        ],
        ClientAlbumCreatedEvent::class => [
            ClientAlbumCreatedEventHandler::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
