<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
use App\Services\MakePdfAlbumService;
use App\Services\MakePdfAlbumFiguresGirdService;

class MyAlbumPdfController extends Controller
{
    public $makePdfAlbumService;
    public $makePdfAlbumFiguresGirdService;

    public function __construct(MakePdfAlbumService $makePdfAlbumService, 
        MakePdfAlbumFiguresGirdService $makePdfAlbumFiguresGirdService)
    {
        $this->makePdfAlbumService = $makePdfAlbumService;
        $this->makePdfAlbumFiguresGirdService = $makePdfAlbumFiguresGirdService;
    }

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

        $fileName = $this->makePdfAlbumService->make($order);

        return Storage::disk(env('STORAGE', 'local'))->download($fileName);
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

        $fileName = $this->makePdfAlbumFiguresGirdService->make($order);

        return Storage::disk(env('STORAGE', 'local'))->download($fileName);
    }

    /**
     * Download image.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function getImage($id, $imageId)
    {
        $order = AlbumOrder::where('transaction_id', $id)
        ->firstOrFail();

        $file = $order->files()->where('id', $imageId)
        ->firstOrFail();

        return Storage::disk(env('STORAGE', 'local'))->download($file->path);
    }
}
