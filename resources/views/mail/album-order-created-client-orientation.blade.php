<html lang="pt=BR">
<head>
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

    <p>Proceda com a requisição do album, clique no link abaixo, e siga os passos, 1º monte seu album, 2º preencha o formulário e 3º confirme os dados.</p>

    <a href="http://{{ $_SERVER['SERVER_NAME'] }}{{ ((env('APP_DEBUG') == true)? ":".$_SERVER['SERVER_PORT']:"") }}/meu-album/{{ $order->transaction_id }}">
        http://{{ $_SERVER['SERVER_NAME'] }}{{ ((env('APP_DEBUG') == true)? ":".$_SERVER['SERVER_PORT']:"") }}/meu-album/{{ $order->transaction_id }}
    </a>

    @include('mail.partials.contact-us')
</body>
</html>
