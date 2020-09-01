<?php

namespace App\Services;

use App\AlbumOrder;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use App\Enums\AlbumFrameTypeEnum;
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
            'printFigureGridPageType',
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

        $fileName = "$baseDir/gabarito.pdf";

        if(!Storage::disk(env('STORAGE', 'local'))->exists($fileName))
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
                    $qttRowsByPage = 8;
                    $qttFiguresByRow = 5;
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
