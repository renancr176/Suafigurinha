@extends('layouts.home.master')
@section('Titulo', 'Sua Figurinha - Meu Album')
@section('styles')
    @parent
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
@endsection
@section('scripts')
    @parent
    <script src="/files/js/inputmask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
@endsection
@section('content')
    <div class="container">
        <div class="mx-auto border border-secondary" style="width: 800px; background-color: #1e1f24">
            <div class="fotorama"
                data-width="800"
                data-nav="thumbs">
                @foreach ($album->pages as $page)
                    {!! '<img src="/'.$page->image_path.'"/>' !!}
                @endforeach
            </div>
        </div>
    </div>
@endsection
