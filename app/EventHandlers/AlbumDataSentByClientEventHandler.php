<?php

namespace App\EventHandlers;

use App\Events\AlbumDataSentByClientEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ClientAlbumCreatedEvent;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use App\Enums\AlbumOrderFileTypeEnum;

class AlbumDataSentByClientEventHandler
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AlbumDataSentByClientEvent  $event
     * @return void
     */
    public function handle(AlbumDataSentByClientEvent $event)
    {
        $baseDir = "album_orders/".$event->order->transaction_id;

        $album = $event->order->Album()->with([
            'pageType',
            'pages' => function($query){
                $query->orderBy('sequence');
            },
            'pages.photos' => function($query){
                $query->orderBy('sequence');
            },
            'pages.photos.frameType',
            'pages.texts',
            'pages.texts.font',
            'pages.backgrounds'
        ])->first();

        $files = $event->order->files()
        ->where('album_order_file_type_id', AlbumOrderFileTypeEnum::Background)
        ->get();

        $texts = $event->order->texts()->get();

        $albumPages = PDF::loadView('pdf.album-pages', compact('album', 'files', 'texts'))
        ->setWarnings(false)
        ->setPaper($album->pageType->type, $album->page_orientation)
        ->output();
        $fileName = "$baseDir/album.pdf";
        Storage::disk('local')->put($fileName, $albumPages);

        $event->order->files()->updateOrCreate([
            'album_order_file_type_id' => AlbumOrderFileTypeEnum::Album,
            'sequence' => 0,
            'path' => $fileName
        ]);

        $files = $event->order->files()
        ->where('album_order_file_type_id', AlbumOrderFileTypeEnum::Figure)
        ->get();

        $figuresGrid = PDF::loadView('pdf.album-figures-grid', compact('files'))
        ->setWarnings(false)
        ->setPaper('A3', 'Portrait')
        ->output();
        $fileName = "$baseDir/gabarito.pdf";
        Storage::disk('local')->put($fileName, $figuresGrid);

        $event->order->files()->updateOrCreate([
            'album_order_file_type_id' => AlbumOrderFileTypeEnum::FigureGrid,
            'sequence' => 0,
            'path' => $fileName
        ]);

        ClientAlbumCreatedEvent::dispatch($event->order);
    }
}
