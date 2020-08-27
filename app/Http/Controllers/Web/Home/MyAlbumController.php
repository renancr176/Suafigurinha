<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MyAlbumRequest;
use App\AlbumOrder;
use App\Services\MakeAlbumService;
use App\State;

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
        return redirect(env('BASE_SITE'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect(env('BASE_SITE'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect(env('BASE_SITE'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = AlbumOrder::where('transaction_id', $id)
        ->where('completed', false)
        ->firstOrFail();

        $album = $order->album()->with([
            'pageType',
            'frameType',
            'pages' => function($query){
                $query->orderBy('sequence');
            },
            'pages.photos' => function($query){
                $query->orderBy('sequence');
            },
            'pages.texts',
            'pages.backgrounds'
        ])->firstOrFail();

        $fonts = array();
        foreach($album->pages()->get() as $page)
            foreach($page->texts()->get() as $text)
                array_push($fonts, $text->font);

        $states = State::get();

        return view('home.my-album.index', compact('order', 'album', 'fonts', 'states'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect(env('BASE_SITE'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
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
        
        return redirect()->route('meu-album.sucesso', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect(env('BASE_SITE'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, $id)
    {
        return dd($request::all());
    }
}
