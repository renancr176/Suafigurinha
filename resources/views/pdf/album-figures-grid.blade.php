<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        {!! "@font-face {font-family: '".$frameType->font->title."'; src: url('".public_path($frameType->font->path)."');}" !!}

        @page
        {
            size: {{ $album->printFigureGridPageType->width }}mm {{ $album->printFigureGridPageType->height }}mm;
        }

        html,
        body
        {
            margin: 0px;
            padding: 0px;
            width: {{ $album->printFigureGridPageType->width }}mm;
            height: {{ $album->printFigureGridPageType->height }}mm;
        }

        table
        {
            border: 3mm;
            border-spacing: 3mm;
            margin-left: auto;
            margin-right: auto;
            margin-top: auto;
            margin-bottom: auto;
            padding: 0px;
            background-color: {{ $album->background_color_firgure_grid }};
        }

        .page
        {
            page-break-after: always;
        }

        .page:last-child
        {
            page-break-after: avoid;
        }

        .page-bg td
        {
            position: relative;
            width: {{ $frameType->width }}mm; 
            height: {{ $frameType->height }}mm;
        }

        .page-bg .figure-bg-num
        {
            position: absolute;
            padding: 0px;
            margin: 0px;
            color: #F5874F;
        }

        .space
        {
            margin-left: 8px;
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
                <td>
                    <img src="{{ $figure['path'] }}" style="width: {{ $frameType->width }}mm;
                    height: {{ $frameType->height }}mm;"/>
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
                <td>
                    <img src="{{ public_path($frameType->image_path) }}" style="width: {{ $frameType->width }}mm;
                    height: {{ $frameType->height }}mm;"/>
                    <p class="figure-bg-num" style="top: {{ $frameType->y_position }}mm;
                    left: {{ $frameType->x_position }}mm;
                    font-size: {{ $frameType->sequence_font_size }}pt;
                    font-family: '{{ $frameType->font->title }}';">
                        @if (substr($figure['sequence'], 0, 1) == "1")
                            {!! '<span class="space">'.$figure['sequence'].'</span>' !!}
                        @else
                            {{ $figure['sequence'] }}
                        @endif
                    </p>
                </td>
            @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    @endforeach
</body>
</html>
