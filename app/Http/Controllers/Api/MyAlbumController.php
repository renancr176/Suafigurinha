<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MyAlbumRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\AlbumOrder;
use App\Services\MakeAlbumService;

class MyAlbumController extends Controller
{
    public $makeAlbumService;

    public function __construct(MakeAlbumService $makeAlbumService)
    {
        $this->makeAlbumService = $makeAlbumService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MyAlbumRequest $request, $id)
    {
        $order = AlbumOrder::where('transaction_id', $id)
        ->where('completed', false)
        ->firstOrFail();

        if(!$this->makeAlbumService->requestIsValid($request, $order))
            response(null, 400);

        $this->makeAlbumService->make($request, $order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
