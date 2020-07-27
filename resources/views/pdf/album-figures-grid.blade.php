<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        {!! "@font-face {font-family: '".$frameType->font->title."'; src: url('".$frameType->font->path."');}" !!}
        
        body
        {
            margin: 4.5mm;
            padding: 0px;
        }

        table,
        table td
        {
            border: none;
            border-spacing: 0px;
            margin: 0px;
            padding: 0px;
        }

        .page
        {
            page-break-after: always;
        }

        .page:last-child
        {
            page-break-after: avoid;
        }

        .page-bg
        {
            float: right;
        }

        .page-bg img
        {
            position: fixed;
        }

        .figure-bg-num
        {
            position: relative;
            padding: 0px;
            margin: 0px;
            color: #F5874F;
            display: inline;
        }
    </style>
</head>
<body>
    @foreach ($figuresGrid as $page)
    <table class="page">
        <tbody>
        @foreach ($page as $row)
            <tr>
            @foreach ($row as $k => $figure)
                <td style="width: {{ $frameType->width }}mm;">
                    <img src="{{ $figure['path'] }}" style="width: {{ $frameType->width }}mm; height: {{ $frameType->height }}mm;"/>
                </td>
            @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    <table class="page page-bg">
        <tbody>
        @foreach ($page as $row)
            <tr>
            @foreach (array_reverse($row) as $k => $figure)
                <td class="display-grid" style="width: {{ $frameType->width }}mm;">
                    <img src="{{ $frameType->image_path }}" style="width: {{ $frameType->width }}mm; height: {{ $frameType->height }}mm;"/>
                    <p class="figure-bg-num" style="top: {{ $frameType->y_position }}mm; left: {{ $frameType->x_position }}mm; font-family: '{{ $frameType->font->title }}';">{{ $figure['sequence'] }}</p>
                </td>
            @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    @endforeach
</body>
</html>
