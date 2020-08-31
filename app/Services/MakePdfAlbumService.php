<?php

namespace App\Services;

use App\AlbumOrder;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use App\Enums\AlbumOrderFileTypeEnum;
use App\Enums\BookbindingTypeEnum;

class MakePdfAlbumService
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
        $fileName = "$baseDir/album.pdf";

        $album = $order->album()->with([
            'presentationPageType',
            'printPageType',
            'frameType',
            'pages' => function($query) use ($order)
            {
                if ($order->bookbinding_type_id == BookbindingTypeEnum::Pasting)
                    $query->where('id', '<>', $order->album()->first()->pages()->orderBy('sequence', 'asc')->first()->id)
                    ->where('id', '<>', $order->album()->first()->pages()->orderBy('sequence', 'desc')->first()->id)
                    ->orderBy('sequence');
                else
                    $query->orderBy('sequence');
            },
            'pages.photos' => function($query){
                $query->orderBy('sequence');
            },
            'pages.texts',
            'pages.texts.font',
            'pages.backgrounds'
        ])->first();

        if(!Storage::disk(env('STORAGE', 'local'))->exists($fileName))
        {
            $backgrounds = [];
            $texts = [];
            $marginWidth = (($album->printPageType->width - $album->presentationPageType->width) / 2);
            $marginHeight = (($album->printPageType->height - $album->presentationPageType->height) / 2);

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
                        'x_position' => $albumBackground->x_position + $marginWidth,
                        'y_position' => $albumBackground->y_position + $marginHeight,
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
                        'x_position' => $albumText->x_position + $marginWidth,
                        'y_position' => $albumText->y_position + $marginHeight,
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

            $albumPagesPdf = PDF::loadView('pdf.album-pages', compact('album', 'fonts', 'backgrounds', 'texts', 'marginWidth', 'marginHeight'))
            ->setWarnings(false)
            ->output();

            Storage::disk(env('STORAGE', 'local'))->put($fileName, $albumPagesPdf);

            $order->files()->updateOrCreate([
                'album_order_file_type_id' => AlbumOrderFileTypeEnum::Album,
                'sequence' => 0,
                'path' => $fileName
            ]);
        }

        return $fileName;
    }
}
