<html lang="pt-BR">
<head>
</head>
<body>
    <h1>{{ env('APP_NAME') }}</h1>
    <p>Protocolo: {{ $order->transaction_id }}</p>
    <p>Recebemos seu album, logo iremos dar inicio ao processo de impressão e envio.</p>
    @include('mail.partials.contact-us')
</body>
</html>
