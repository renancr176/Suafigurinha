<?php

namespace App\Services;

use App\AlbumOrder;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use App\Enums\AlbumOrderFileTypeEnum;

class MakePdfAlbumFiguresGirdService
{
    /**
     * Make PDF.
     *
     * @param  AlbumOrder  $order
     * @return string
     */
    public function make(AlbumOrder $order)
    {
        $baseDir = "album_orders/".$order->transaction_id;

        $album = $order->Album()->with([
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

        $frameType = $album->frameType()->with([
            'printPageType',
            'font'
        ])->first();

        $fileName = "$baseDir/gabarito.pdf";

        if(!Storage::disk(env('STORAGE', 'local'))->exists($fileName))
        {
            $figuresGrid = [];
            $page = 1;
            $figureCount = 1;
            $row = 0;
            $figuresGrid[$page] = [$row => []];

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
                    if (($figureCount % $frameType->quantity_figures_by_row) == 0)
                    {
                        $row++;
                        if(($row % $frameType->quantity_rows_by_page) == 0)
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

            //die(view('pdf.album-figures-grid', compact('album', 'frameType', 'figuresGrid')));

            $figuresGridPdf = PDF::loadView('pdf.album-figures-grid', compact('album', 'frameType', 'figuresGrid'))
            ->setWarnings(false)
            ->output();

            Storage::disk(env('STORAGE', 'local'))->put($fileName, $figuresGridPdf);

            $order->files()->updateOrCreate([
                'album_order_file_type_id' => AlbumOrderFileTypeEnum::FigureGrid,
                'sequence' => 0,
                'path' => $fileName
            ]);
        }

        return $fileName;
    }
}
