<?php

namespace App\Services;

use App\AlbumOrder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\AlbumCover;
use App\Enums\AlbumConverTypeEnum;
use App\Enums\AlbumOrderFileTypeEnum;

class MakePdfAlbumCoverService
{
    /**
     * Make PDF.
     *
     * @param  AlbumOrder  $order
     * @return string
     */
    public function make(AlbumOrder $order)
    {
        $fileName = "album_orders/$order->transaction_id/capa_dura.pdf";

        if(!Storage::disk(env('STORAGE', 'local'))->exists($fileName))
        {
            $album = $order->album()->with([
                'presentationPageType',
                'presentationCoverPageType',
                'printCoverPageType'
            ])
            ->first();

            $covers = DB::table('album_pages')
                ->join('album_covers', 'album_pages.id', 'album_covers.album_page_id')
                ->get();

            $frontCover = AlbumCover::where('album_page_id', $covers->where('album_cover_type_id', AlbumConverTypeEnum::Front)->first()->id)->firstOrFail();
            $backCover = AlbumCover::where('album_page_id', $covers->where('album_cover_type_id', AlbumConverTypeEnum::Back)->first()->id)->firstOrFail();

            $frontBackPages = array(
                $frontCover->albumPage()
                ->with([
                    'backgrounds',
                    'texts',
                    'texts.font'
                ])
                ->first(),
                $backCover->albumPage()
                ->with([
                    'backgrounds',
                    'texts',
                    'texts.font'
                ])
                ->first()
            );

            $externalCutsWidth = ((($album->printCoverPageType->width - (2 * $album->presentationCoverPageType->width))) / 2) - $album->print_cut_space;
            $externalCutsHeight = 10;
            $middleCutRowHight = ((($album->printCoverPageType->height - $album->presentationCoverPageType->height) - (2 * $externalCutsHeight)) / 2) - $album->print_cut_space;
            $diffPresentationPagesWidth = $externalCutsWidth + (($album->presentationCoverPageType->width - $album->presentationPageType->width) / 2) + $album->print_cut_space;
            $diffPresentationPagesHeight = $externalCutsHeight + $middleCutRowHight + (($album->presentationCoverPageType->height - $album->presentationPageType->height) / 2) + $album->print_cut_space;

            $backgrounds = [];
            $texts = [];
            $fonts = [];

            foreach($frontBackPages as $albumPage)
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

                    array_push($fonts, $albumText->font);

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

            //die(view('pdf.album-cover', compact('album', 'fonts', 'frontCover', 'backCover', 'backgrounds', 'texts', 'diffPresentationPagesWidth', 'diffPresentationPagesHeight')));

            $albumPagesPdf = PDF::loadView('pdf.album-cover',
                compact(
                    'album',
                    'fonts',
                    'frontCover',
                    'backCover',
                    'backgrounds',
                    'texts',
                    'externalCutsWidth',
                    'externalCutsHeight',
                    'diffPresentationPagesWidth',
                    'diffPresentationPagesHeight',
                    'middleCutRowHight'
                )
            )
            ->setWarnings(false)
            ->output();

            Storage::disk(env('STORAGE', 'local'))->put($fileName, $albumPagesPdf);

            $order->files()->updateOrCreate([
                'album_order_file_type_id' => AlbumOrderFileTypeEnum::Cover,
                'sequence' => 0,
                'path' => $fileName
            ]);
        }

        return $fileName;
    }
}
