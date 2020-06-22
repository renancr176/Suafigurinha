<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="{{ route('home') }}"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
    aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Álbuns Colecionáveis
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/lbuns-colecion-veis">Álbuns Colecionáveis</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/hype">Diferentões</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/agrandefamilia">Família êh! Família ah! Família!</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/fica-vai-ter-bolo-1">Fica, vai ter bolo!</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/good-vibes-1">Good Vibes</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/momentos">Momentos</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/morz-o">Mozão</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/p-na-estrada">Pé na estrada</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/prazer-qual-o-seu-signo">Prazer, qual é o seu signo?</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/tamo-junto">Tamo Junto</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/universo-kids">Universo Kids</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Álbuns Personalizados
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/albuns-personalizados-1">Álbuns Personalizados</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/amizade">Amizade</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/amor">Amor</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/anivers-rio">Aniversário</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/datas-especiais">Datas Especiais</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/fam-lia">Família</a>
                    <a class="dropdown-item" href="{{env('BASE_SITE')}}/infantil">Infantil</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{env('BASE_SITE')}}/100personalizado">100% Personalizado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{env('BASE_SITE')}}/foto-produtos-1">Foto Produtos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{env('BASE_SITE')}}/novidades">Mais Vendidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{env('BASE_SITE')}}/duvidas-frequentes">Dúvidas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{env('BASE_SITE')}}/blog">Blog</a>
            </li>
        </ul>
    </div>
</nav>
