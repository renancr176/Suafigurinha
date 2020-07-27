<?php

namespace App\EventHandlers;

use App\Events\AlbumDataSentByClientEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ClientAlbumCreatedEvent;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use App\Enums\AlbumOrderFileTypeEnum;
use App\Enums\AlbumFrameTypeEnum;

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

        #region PDF Album Pages

        $backgrounds = [];
        $texts = [];
        
        foreach($album->pages()->get() as $albumPage)
        {
            foreach($albumPage->backgrounds()->get() as $albumBackground)
            {
                $backgroundObj = $event->order->files()
                ->where('album_order_file_type_id', AlbumOrderFileTypeEnum::Background)
                ->where('sequence', $albumBackground->sequence)
                ->first();

                if(!array_key_exists($album->pages->id, $backgrounds))
                    $backgrounds[$album->pages->id] = [];

                array_push($backgrounds[$album->pages->id], [
                    'x_position' => $albumBackground->x_position,
                    'y_position' => $albumBackground->y_position,
                    'rotation' => $albumBackground->rotation,
                    'width' => $albumBackground->width,
                    'height' => $albumBackground->height,
                    'path' => Storage::disk('local')->temporaryUrl($backgroundObj->path, now()->addMinutes(5))
                ]);
            }

            foreach($albumPage->texts()->get() as $albumText)
            {
                $textObj = $event->order->texts()
                ->where('album_page_id', $albumPage->id)
                ->where('album_page_text_id', $albumText->id)
                ->first();

                if(!array_key_exists($album->pages->id, $texts))
                    $texts[$album->pages->id] = [];

                array_push($texts[$album->pages->id], [
                    'width' => $albumText->width,
                    'x_position' => $albumText->x_position,
                    'y_position' => $albumText->y_position,
                    'rotation' => $albumText->rotation,
                    'color' => $albumText->color,
                    'alignment' => $albumText->alignment,
                    'font_size' => $albumText->font_size,
                    'font_family' => $albumText->font()->first()->title,
                    'text' => $textObj->text
                ]);
            }
        }

        $fonts = array();
        foreach($album->pages()->get() as $page)
            foreach($page->texts()->get() as $text)
                array_push($fonts, $text->font);

        $albumPagesPdf = PDF::loadView('pdf.album-pages', compact('album', 'fonts', 'backgrounds', 'texts'))
        ->setWarnings(false)
        ->setPaper($album->pageType->type, $album->page_orientation)
        ->output();
        $fileName = "$baseDir/album.pdf";
        Storage::disk('local')->put($fileName, $albumPagesPdf);

        $event->order->files()->updateOrCreate([
            'album_order_file_type_id' => AlbumOrderFileTypeEnum::Album,
            'sequence' => 0,
            'path' => $fileName
        ]);

        #endregion

        #region PDF Album Figures Grid

        $figuresGrid = [];
        $page = 1;
        $figureCount = 1;
        $row = 0;
        $figuresGrid[$page] = [$row => []];
        $frameType = $album->frameType()->with(['font'])->first();
        $qttRowsByPage = 6;
        $qttFiguresByRow = 4;
        switch($frameType->id)
        {
            case AlbumFrameTypeEnum::Small:
                $qttRowsByPage = 6;
                $qttFiguresByRow = 4;
                break;
            case AlbumFrameTypeEnum::Medium:
                $qttRowsByPage = 6;
                $qttFiguresByRow = 4;
                break;
            case AlbumFrameTypeEnum::Big:
                $qttRowsByPage = 5;
                $qttFiguresByRow = 3;
                break;
        }

        $figures = $event->order->files()
        ->where('album_order_file_type_id', AlbumOrderFileTypeEnum::Figure)
        ->orderBy('sequence')
        ->get();

        foreach($figures as $figureObj)
        {
            array_push($figuresGrid[$page][$row], [
                'path' => Storage::disk('local')->temporaryUrl($figureObj->path, now()->addMinutes(5)),
                'sequence' => $figureObj->sequence
            ]);

            $figureCount++;

            if($figureCount <= count($figures))
            {
                if (($figureCount % $qttFiguresByRow) == 0)
                {
                    $row++;
                    if((($row + 1) % $qttRowsByPage) == 0)
                    {
                        $page++;
                        $row = 0;
                        $figuresGrid[$page] = [$row => []];
                    }
                    else
                        $figuresGrid[$page][$row] = [];
                }
            }
        }

        $figuresGridPdf = PDF::loadView('pdf.album-figures-grid', compact('frameType', 'figuresGrid'))
        ->setWarnings(false)
        ->setPaper('A3', 'Portrait')
        ->output();
        $fileName = "$baseDir/gabarito.pdf";
        Storage::disk('local')->put($fileName, $figuresGridPdf);

        $event->order->files()->updateOrCreate([
            'album_order_file_type_id' => AlbumOrderFileTypeEnum::FigureGrid,
            'sequence' => 0,
            'path' => $fileName
        ]);

        #endregion

        ClientAlbumCreatedEvent::dispatch($event->order);
    }
}
