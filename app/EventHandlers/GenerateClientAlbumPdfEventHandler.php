<?php

namespace App\EventHandlers;

use App\Events\GenerateClientAlbumPdfEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\MakePdfAlbumService;
use App\Services\MakePdfAlbumFiguresGirdService;
use App\Services\MakePdfAlbumCoverService;
use App\Enums\BookbindingTypeEnum;

class GenerateClientAlbumPdfEventHandler implements ShouldQueue
{
    public $makePdfAlbumService;
    public $makePdfAlbumFiguresGirdService;
    public $makePdfAlbumCoverService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MakePdfAlbumService $makePdfAlbumService,
        MakePdfAlbumFiguresGirdService $makePdfAlbumFiguresGirdService,
        MakePdfAlbumCoverService $makePdfAlbumCoverService)
    {
        $this->makePdfAlbumService = $makePdfAlbumService;
        $this->makePdfAlbumFiguresGirdService = $makePdfAlbumFiguresGirdService;
        $this->makePdfAlbumCoverService = $makePdfAlbumCoverService;
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
        if ($event->order->bookbinding_type_id == BookbindingTypeEnum::Pasting)
            $this->makePdfAlbumCoverService->make($event->order);
    }
}
