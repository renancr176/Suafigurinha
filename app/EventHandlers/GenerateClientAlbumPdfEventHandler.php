<?php

namespace App\EventHandlers;

use App\Events\GenerateClientAlbumPdfEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\MakePdfAlbumService;
use App\Services\MakePdfAlbumFiguresGirdService;

class GenerateClientAlbumPdfEventHandler implements ShouldQueue
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
     * @param  GenerateClientAlbumPdfEvent  $event
     * @return void
     */
    public function handle(GenerateClientAlbumPdfEvent $event)
    {
        $this->makePdfAlbumService->make($event->order);
        $this->makePdfAlbumFiguresGirdService->make($event->order);
    }
}
