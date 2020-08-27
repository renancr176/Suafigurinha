<?php

namespace App\EventHandlers;

use App\Events\AlbumDataSentByClientEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\MakePdfAlbumService;
use App\Services\MakePdfAlbumFiguresGirdService;
use App\Events\ClientAlbumCreatedEvent;

class AlbumDataSentByClientEventHandler implements ShouldQueue
{
    public $makePdfAlbumService;
    public $makePdfAlbumFiguresGirdService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MakePdfAlbumService $makePdfAlbumService, 
        MakePdfAlbumFiguresGirdService $makePdfAlbumFiguresGirdService)
    {
        $this->makePdfAlbumService = $makePdfAlbumService;
        $this->makePdfAlbumFiguresGirdService = $makePdfAlbumFiguresGirdService;
    }

    /**
     * Handle the event.
     *
     * @param  AlbumDataSentByClientEvent  $event
     * @return void
     */
    public function handle(AlbumDataSentByClientEvent $event)
    {
        $this->makePdfAlbumService->make($event->order);
        $this->makePdfAlbumFiguresGirdService->make($event->order);

        ClientAlbumCreatedEvent::dispatch($event->order);
    }
}
