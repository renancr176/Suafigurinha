<html lang="pt-BR">
<head>
</head>
<body>
    <h1>{{ env('APP_NAME') }}</h1>
    <p><b>Falha ao tentar registrar pedido de album, segue abaixo os dados recebido.</b></p>
    <hr/>
    @if ($message != '')
        <p>{{ $message }}</p>
    @endif
    <ul>
    @foreach ($inputs as $key => $value)
        <li>{{ $key }}: {{ $value }}</li>
    @endforeach
    </ul>
</body>
</html>
