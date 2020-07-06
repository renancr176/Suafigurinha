@extends('layouts.home.master')
@section('Titulo', 'Sua Figurinha - Meu Album')
@section('styles')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <link rel="stylesheet" href="/files/css/croppie.css">
    <link rel="stylesheet" href="/files/css/my-album.css">
    <link rel="stylesheet" href="/files/css/hover-min.css">
    <style>
        @foreach ($fonts as $font)
        {!! "@font-face {font-family: '".$font->title."'; src: url('".$font->path."');}" !!}
        @endforeach
    </style>
@endsection
@section('scripts')
    @parent
    <script type="text/javascript" src="/files/js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="/files/js/exif.js"></script>
    <script type="text/javascript" src="/files/js/croppie.min.js"></script>
    <script type="text/javascript" src="/files/js/fotorama.js"></script>
    <script type="text/javascript" src="/files/js/my-album.js"></script>
@endsection
@section('content')
    <div class="container">
        <h5 class="text-center text-secondary">Álbum Personalizado - {{ $album->title }}</h5>
        <hr/>
        <div class="row text-center">
            <div class="col-sm hvr-underline-from-center step step-1" step="1">
                <img src="/files/images/album/steps/step-1.png"  class="imageimg-fluid" alt="Passo 1 - Montagem do album">
            </div>
            <div class="col-sm hvr-underline-from-center step step-2" step="2">
                <img src="/files/images/album/steps/step-2.png" class="imageimg-fluid" alt="Passo 2 - Dados de envio">
            </div>
            <div class="col-sm hvr-underline-from-center step step-3" step="3">
                <img src="/files/images/album/steps/step-3.png" class="imageimg-fluid" alt="Passo 3 - Conferência e confirmação">
            </div>
        </div>
        <div id="step-1-content" class="step-content active">
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
        </div>
        <div id="step-2-content" class="step-content form">
            <h5 class="text-center">Informação de contato</h5>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="client-name">* Nome</label>
                        <input type="text" name="client_name" class="form-control" id="client-name" required placeholder="Informe o seu nome completo">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="email">* E-mail</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="phone">* Celular / Whats App</label>
                        <input type="text" name="phone_number" class="form-control phone" id="phone" required placeholder="(__) ____-____">
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <hr/>
            <h5 class="text-center">Endereço de entrega</h5>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="zipcode">* Cep</label>
                        <input type="text" name="zipcode" class="form-control zipcode" id="zipcode" required placeholder="_____-___">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="state">* Estado</label>
                        <select name="state" class="form-control" id="state" required>
                            <option></option>
                            @foreach ($states as $state)
                                {!! '<option value="'.$state->uf.'">'.$state->name.'</option>' !!}
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="city">* Cidade</label>
                        <input type="text" name="city" class="form-control" id="city" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="district">* Bairro</label>
                        <input type="text" name="district" class="form-control" id="district" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="address">* Endereço</label>
                        <input type="text" name="address" class="form-control" id="address" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="address-number">* Número</label>
                        <input type="number" name="address_number" class="form-control" id="address-number" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="complement">Complemento</label>
                        <input type="text" name="complement" class="form-control" id="complement">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="receiver-name">* Nome do recebedor</label>
                        <input type="text" name="receiver_name" class="form-control" id="receiver-name" required placeholder="Nome completo">
                    </div>
                </div>
            </div>
        </div>
        <div id="step-3-content" class="step-content">
            {!! Form::open(['route' => ['meu-album.update', $order->transaction_id], 'method' => 'post', 'files' => true]) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
