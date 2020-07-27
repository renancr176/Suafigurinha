<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use App\AlbumOrder;
use App\Enums\AlbumOrderFileTypeEnum;
use App\Enums\AlbumFrameTypeEnum;

class MyAlbumPdfController extends Controller
{
    /**
     * Download PDF.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function getPagesPdf($id)
    {
        $order = AlbumOrder::where('transaction_id', $id)
        ->firstOrFail();

        $baseDir = "album_orders/".$order->transaction_id;

        $album = $order->Album()->with([
            'pageType',
            'pages' => function($query){
                $query->orderBy('sequence');
            },
            'pages.photos' => function($query){
                $query->orderBy('sequence');
            },
            'pages.texts',
            'pages.texts.font',
            'pages.backgrounds'
        ])->first();

        #region PDF Album Pages

        $fileName = "$baseDir/album.pdf";

        if(!Storage::disk('local')->exists($fileName))
        {
            $backgrounds = [];
            $texts = [];

            foreach($album->pages()->get() as $albumPage)
            {
                foreach($albumPage->backgrounds()->get() as $albumBackground)
                {
                    $backgroundObj = $order->files()
                    ->where('album_order_file_type_id', AlbumOrderFileTypeEnum::Background)
                    ->where('sequence', $albumBackground->sequence)
                    ->first();

                    if(!array_key_exists($albumPage->id, $backgrounds))
                        $backgrounds[$albumPage->id] = [];

                    array_push($backgrounds[$albumPage->id], [
                        'x_position' => $albumBackground->x_position,
                        'y_position' => $albumBackground->y_position,
                        'rotation' => $albumBackground->rotation,
                        'width' => $albumBackground->width,
                        'height' => $albumBackground->height,
                        'path' => "../storage/app/$backgroundObj->path"
                    ]);
                }

                foreach($albumPage->texts()->get() as $albumText)
                {
                    $textObj = $order->texts()
                    ->where('album_page_id', $albumPage->id)
                    ->where('album_page_text_id', $albumText->id)
                    ->first();

                    if(!array_key_exists($albumPage->id, $texts))
                        $texts[$albumPage->id] = [];

                    array_push($texts[$albumPage->id], [
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

            Storage::disk('local')->put($fileName, $albumPagesPdf);

            $order->files()->updateOrCreate([
                'album_order_file_type_id' => AlbumOrderFileTypeEnum::Album,
                'sequence' => 0,
                'path' => $fileName
            ]);
        }

        #endregion

        return Storage::disk('local')->download($fileName);
    }

    /**
     * Download PDF.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function getGridPdf($id)
    {
        $order = AlbumOrder::where('transaction_id', $id)
        ->firstOrFail();

        $baseDir = "album_orders/".$order->transaction_id;

        $album = $order->Album()->with([
            'pageType',
            'frameType',
            'pages' => function($query){
                $query->orderBy('sequence');
            },
            'pages.photos' => function($query){
                $query->orderBy('sequence');
            },
            'pages.texts',
            'pages.texts.font',
            'pages.backgrounds'
        ])->first();

        #region PDF Album Figures Grid

        $fileName = "$baseDir/gabarito.pdf";

        if(!Storage::disk('local')->exists($fileName))
        {
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

            $figures = $order->files()
            ->where('album_order_file_type_id', AlbumOrderFileTypeEnum::Figure)
            ->orderBy('sequence')
            ->get();

            foreach($figures as $figureObj)
            {
                array_push($figuresGrid[$page][$row], [
                    'path' => "../storage/app/$figureObj->path",
                    'sequence' => str_pad($figureObj->sequence, 2, "0", STR_PAD_LEFT)
                ]);

                if($figureCount <= count($figures))
                {
                    if (($figureCount % $qttFiguresByRow) == 0)
                    {
                        $row++;
                        if(($row % $qttRowsByPage) == 0)
                        {
                            $page++;
                            $row = 0;
                            $figuresGrid[$page] = [$row => []];
                        }
                        else if(($figureCount + 1) <= count($figures))
                            $figuresGrid[$page][$row] = [];
                    }
                }

                $figureCount++;
            }

            $figuresGridPdf = PDF::loadView('pdf.album-figures-grid', compact('frameType', 'figuresGrid'))
            ->setWarnings(false)
            ->setPaper('A3', 'Portrait')
            ->output();

            Storage::disk('local')->put($fileName, $figuresGridPdf);

            $order->files()->updateOrCreate([
                'album_order_file_type_id' => AlbumOrderFileTypeEnum::FigureGrid,
                'sequence' => 0,
                'path' => $fileName
            ]);
        }

        #endregion

        return Storage::disk('local')->download($fileName);
    }
}
