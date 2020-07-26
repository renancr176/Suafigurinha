<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        body,
        table
        {
            margin: 0px;
            padding: 0px;
        }

        table,
        table td
        {
            border: none;
            border-spacing: 0px;
            padding: 0px;
        }
    </style>
</head>
<body>
    <table>
        <tbody>
        @foreach ($figures as $row)
            <tr>
            @foreach ($row as $k => $figure)
                <td style="width: {{ $figure['width'] }}mm;">
                    <img src="{{ $figure['path'] }}" style="width: {{ $figure['width'] }}mm; height: {{ $figure['height'] }}mm;"/>
                </td>
            @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
