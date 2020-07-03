@extends('layouts.home.master')
@section('Titulo', 'Sua Figurinha - Meu Album')
@section('styles')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <link rel="stylesheet" href="/files/css/croppie.css">
    <link rel="stylesheet" href="/files/css/my-album.css">
    <style>
        @foreach ($fonts as $font)
        {!! "@font-face {font-family: '".$font->title."'; src: url('".$font->path."');}" !!}
        @endforeach
    </style>
@endsection
@section('scripts')
    @parent
    <script src="/files/js/inputmask.min.js"></script>
    <script src="/files/js/exif.js"></script>
    <script src="/files/js/croppie.min.js"></script>
    <script src="/files/js/fotorama.js"></script>
    <script src="/files/js/my-album.js"></script>
@endsection
@section('content')
    <div class="container">
        <h5 class="text-center text-secondary">Álbum Personalizado - {{ $album->title }}</h5>
        <hr/>
        <div class="mx-auto border border-secondary album-pages-container" albumid="{{ $album->id }}" style="width: {{ $album->pageType->width }}mm;">
            <div class="fotorama"
                data-width="{{ $album->pageType->width }}mm"
                data-nav="thumbs"
                data-arrows="false"
                data-click="false"
                data-swipe="false"
                data-transition="dissolve">
                @foreach ($album->pages as $page)
                    {!! '<img src="'.$page->image_path.'" id="'.$page->id.'"/>' !!}
                @endforeach
            </div>
        </div>
        {!! Form::open(['route' => ['meu-album.update', $order->transaction_id], 'method' => 'post', 'files' => true, 'class' => 'hide']) !!}
        {!! Form::close() !!}
    </div>
@endsection
