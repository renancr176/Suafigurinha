<html lang="pt=BR">
<head>
    <style>
        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-primary {
            color: #004085;
            background-color: #cce5ff;
            border-color: #b8daff;
        }

        .alert-primary hr {
            border-top-color: #9fcdff;
        }

        .alert-primary .alert-link {
            color: #002752;
        }

        .alert-warning {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
        }

        .alert-warning hr {
            border-top-color: #ffe8a1;
        }

        .alert-warning .alert-link {
            color: #533f03;
        }
    </style>
</head>
<body>
    <h1>{{ env('APP_NAME') }}</h1>

    <p>Informações do pedido.</p>

    <table border="0" cellpadding="1" style="width:100%">
        <tbody>
            <tr>
                <td style="text-align:right; width:130px">Protocolo:</td>
                <td>{{ $order->transaction_id }}</td>
            </tr>
            <tr>
                <td style="text-align:right">Album:</td>
                <td>{{ "$album->ref_code - $album->title" }}</td>
            </tr>
        </tbody>
    </table>

    <hr/>

    <div class="alert alert-primary" role="alert">
        <p>Proceda com a criação do album, clique no link abaixo, e siga os passos, 1º monte seu album, 2º preencha o formulário e 3º confirme os dados.</p>
        <p>Recomendamos separar as fotos que deseja colocar no album antes de iniciar o processo de criação.</p>
    </div>

    <a href="{{ env('APP_URL') }}/meu-album/{{ $order->transaction_id }}">
        <h2>{{ env('APP_URL') }}/meu-album/{{ $order->transaction_id }}</h2>
    </a>

    <div class="alert alert-warning" role="alert">
        <p>Obs: Os dados da montagem do album não são salvos até completar as etapas e enviar, portanto reserve um tempo para monta-lo, desde que o navegador não seja fechado você não corre o risco de perder a montagem do album.</p>
    </div>

    @include('mail.partials.contact-us')
</body>
</html>
