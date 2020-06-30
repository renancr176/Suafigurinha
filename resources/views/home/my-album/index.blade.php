@extends('layouts.home.master')
@section('Titulo', 'Sua Figurinha - Meu Album')
@section('styles')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <link rel="stylesheet" href="/files/css/my-album.css">
@endsection
@section('scripts')
    @parent
    <script src="/files/js/inputmask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <script src="/files/js/my-album.js"></script>
@endsection
@section('content')
    <div class="container">
        <div class="mx-auto border border-secondary album-pages-container" albumid="{{ $album->id }}" style="width: {{ $album->pageType->width }}mm;">
            <div class="fotorama"
                data-width="{{ $album->pageType->width }}mm"
                data-nav="thumbs">
                @foreach ($album->pages as $page)
                    {!! '<img src="/'.$page->image_path.'" id="'.$page->id.'"/>' !!}
                @endforeach
            </div>
        </div>
    </div>

    <div class="hiden">
        {!! Form::open(['route' => ['meu-album.update', $order->id], 'method' => 'post']) !!}
        {!! Form::close() !!}
    </div>
@endsection
