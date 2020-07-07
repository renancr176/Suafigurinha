<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('Titulo', 'Sua Figurinha')</title>

    @section('styles')
    <link rel="stylesheet" href="/files/css/jquery-ui.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="/files/css/font-awesome-5.13.1.min.css">
    <link rel="stylesheet" href="/files/css/styles.css">
    <link rel="stylesheet" href="/files/css/home.css">
    @show

</head>
<body>

    <div class="topo">
        <a href="{{ env('BASE_SITE') }}/lbuns-colecion-veis" class="link">COLECIONE MOMENTOS</a>

        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="{{ env('BASE_SITE') }}">
                        <img src="/files/images/sua-figurinha.png" class="logo"/>
                    </a>
                </div>
                <div class="col">
                </div>
                <div class="col">
                    <a href="https://api.whatsapp.com/send?phone=551632355960&amp;text= Olá, %20esse%20é%20o%20nosso%20primeiro%20contatinho, %20quero%20saber%20mais%20sobre%20os%20álbuns."
                    target="_blank"
                    data-content="https://api.whatsapp.com/send?phone=551632355960&amp;text= Olá, %20esse%20é%20o%20nosso%20primeiro%20contatinho, %20quero%20saber%20mais%20sobre%20os%20álbuns."
                    data-type="external"
                    rel="noopener"
                    title="Clique aqui!"
                    style="width:27px;height:48px"
                    id="comp-jxoq4ozflink"
                    class="ImageButton_1link inline-block">
                        <div class="ImageButton_1_correct-positioning inline-block"><wix-image style="width:27px;height:48px;top:0;left:0" data-has-bg-scroll-effect="" data-image-info="{&quot;imageData&quot;:{&quot;alt&quot;:&quot;&quot;,&quot;type&quot;:&quot;Image&quot;,&quot;id&quot;:&quot;dataItem-jxoq4p0i1&quot;,&quot;metaData&quot;:{&quot;pageId&quot;:&quot;masterPage&quot;,&quot;isPreset&quot;:false,&quot;schemaVersion&quot;:&quot;2.0&quot;,&quot;isHidden&quot;:false},&quot;title&quot;:&quot;w1.png&quot;,&quot;uri&quot;:&quot;62209d_12649f406119428fad151192b664026d~mv2.png&quot;,&quot;description&quot;:&quot;&quot;,&quot;width&quot;:500,&quot;height&quot;:500,&quot;quality&quot;:{&quot;unsharpMask&quot;:{&quot;radius&quot;:1.2,&quot;amount&quot;:1,&quot;threshold&quot;:0.01}},&quot;displayMode&quot;:&quot;full&quot;},&quot;containerId&quot;:&quot;comp-jxoq4ozf&quot;,&quot;displayMode&quot;:&quot;full&quot;}" data-has-ssr-src="" data-is-svg="false" data-is-svg-mask="false" id="comp-jxoq4ozfdefaultImage" class="ImageButton_1defaultImage" data-src="https://static.wixstatic.com/media/62209d_12649f406119428fad151192b664026d~mv2.png/v1/fill/w_34,h_34,al_c,q_85,usm_1.20_1.00_0.01/62209d_12649f406119428fad151192b664026d~mv2.webp"><img id="comp-jxoq4ozfdefaultImageimage" style="object-position:50% 50%;width:27px;height:48px;object-fit:contain" alt="" data-type="image" itemprop="image" src="https://static.wixstatic.com/media/62209d_12649f406119428fad151192b664026d~mv2.png/v1/fill/w_34,h_34,al_c,q_85,usm_1.20_1.00_0.01/62209d_12649f406119428fad151192b664026d~mv2.webp"></wix-image></div>
                    </a>
                    <span class="inline-block">(16) 3235-5960</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
    @include('home.partials.menu')
    </div>

    <main>
    @yield('content')
    </main>

    <footer class="page-footer">
    </footer>

    <div id="toast-container" aria-live="polite" aria-atomic="true"></div>

    @section('scripts')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="/files/js/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $.widget.bridge('uitooltip', $.ui.tooltip);
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    @show

</body>
</html>
