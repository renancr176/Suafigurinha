<html lang="pt-BR">
<head>
</head>
<body>
    <h1>{{ env('APP_NAME') }}</h1>
    <p><b>Falha ao tentar enviar e-mail</b></p>
    <hr/>
    @foreach ($data as $value)
        @if (is_array($value))
            @php
                print_r($value);
            @endphp
        @else
            {!! "<p>$value</p>" !!}
        @endif
    @endforeach
</body>
</html>
