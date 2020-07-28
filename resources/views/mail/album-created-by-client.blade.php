<html lang="pt-BR">
<head>
    <style>
        .text-center
        {
            text-align: center;
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        .table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }
        .table > caption + thead > tr:first-child > th,
        .table > colgroup + thead > tr:first-child > th,
        .table > thead:first-child > tr:first-child > th,
        .table > caption + thead > tr:first-child > td,
        .table > colgroup + thead > tr:first-child > td,
        .table > thead:first-child > tr:first-child > td {
            border-top: 0;
        }
        .table > tbody + tbody {
            border-top: 2px solid #ddd;
        }
        .table .table {
            background-color: #fff;
        }

        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>
    <p>Informações do pedido.</p>

    <table border="0" cellpadding="1" style="width:100%">
        <tbody>
            <tr>
                <td style="text-align:right; width:130px">Código de integração:</td>
                <td>{{ $order->transaction_id }}</td>
            </tr>
            <tr>
                <td style="text-align:right">Album:</td>
                <td>{{ "$album->id - $album->ref_code - $album->title" }}</td>
            </tr>
            <tr>
                <td>Links para downloads:</td>
                <td>
                    <ol>
                        <li><a href="{{ env('APP_URL') }}/my-album-pages/{{ $order->transaction_id }}">Album em PDF</a></li>
                        <li><a href="{{ env('APP_URL') }}/my-album-grid/{{ $order->transaction_id }}">Gabarito em PDF</a></li>
                    </ol>
                </td>
            </tr>
        </tbody>
    </table>

    <hr />
    <p>Dados do cliente.</p>

    <table border="0" cellpadding="1" style="width:100%">
        <tbody>
            <tr>
                <td style="text-align:right; width:130px">Nome:</td>
                <td>{{ $client->client_name }}</td>
            </tr>
            <tr>
                <td style="text-align:right">E-mail:</td>
                <td>{{ $client->email }}</td>
            </tr>
            <tr>
                <td style="text-align:right">Telefone:</td>
                <td>{{ $client->phone_number }}</td>
            </tr>
        </tbody>
    </table>

    <hr />
    <p>Dados de entrega.</p>

    <table border="0" cellpadding="1" style="width:100%">
        <tbody>
            <tr>
                <td style="text-align:right; width:130px">Cep:</td>
                <td>{{ $deliveryAddress->zipcode }}</td>
            </tr>
            <tr>
                <td style="text-align:right">Estado:</td>
                <td>{{ $deliveryAddress->state }}</td>
            </tr>
            <tr>
                <td style="text-align:right">Cidade:</td>
                <td>{{ $deliveryAddress->city }}</td>
            </tr>
            <tr>
                <td style="text-align:right">Bairro:</td>
                <td>{{ $deliveryAddress->district }}</td>
            </tr>
            <tr>
                <td style="text-align:right">Endereço:</td>
                <td>{{ $deliveryAddress->address }}</td>
            </tr>
            <tr>
                <td style="text-align:right">Número:</td>
                <td>{{ $deliveryAddress->address_number }}</td>
            </tr>
            <tr>
                <td style="text-align:right">Complemento:</td>
                <td>{{ $deliveryAddress->complement }}</td>
            </tr>
            <tr>
                <td style="text-align:right">Nome do Recebedor:</td>
                <td>{{ $deliveryAddress->receiver_name }}</td>
            </tr>
        </tbody>
    </table>';

    @if (count($texts) > 0)
        <hr />
        <h2>Segue abaixo os textos informados pelo cliente.</h2>

        <table class="table text-center">
            <thead>
                <tr>
                    <th>Página</td>
                    <th>Texto original</td>
                    <th>Texto informado pelo cliente</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($texts as $val)
                <tr>
                    <td>{{ $val['page'] }}</td>
                    <td>{{ $val['original_text'] }}</td>
                    <td>{{ $val['client_text'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    </body>
</html>
