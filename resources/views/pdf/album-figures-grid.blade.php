<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        {!! "@font-face {font-family: '".$frameType->font->title."'; src: url('".public_path($frameType->font->path)."');}" !!}

        @page
        {
            size: {{ $frameType->printPageType->width }}mm {{ $frameType->printPageType->height }}mm;
        }

        html,
        body
        {
            margin: 0px;
            padding: 0px;
            width: {{ $frameType->printPageType->width }}mm;
            height: {{ $frameType->printPageType->height }}mm;
        }

        table.page
        {
            padding: 0px;
            margin: auto;
            page-break-after: always;
            border-spacing: 0px;
        }

        table.page:last-child
        {
            page-break-after: avoid;
        }

        .cut-horizontal-mark
        {
            border-right: 1px solid black;
        }

        .cut-vertical-mark
        {
            border-bottom: 1px solid black;
        }

        /* table.page tr:nth-child(2) td:nth-child({{ $frameType->quantity_figures_by_row + 4 }}),
        table.page tr:nth-last-child(2) td:nth-child({{ $frameType->quantity_figures_by_row + 3 }})
        {
            border-right: none;
        } */

        /* table.page tr:nth-last-child(3) .cut-vertical-mark:first-child,
        table.page tr:nth-last-child(3) .cut-vertical-mark:last-child
        {
            border-bottom: none;
        } */

        table.page.figures-grid td.border-corner,
        table.page.figures-grid td.border-horizontal,
        table.page.figures-grid td.border-vertical,
        table.page.figures-grid td.figure-container
        {
            background-color: {{ $album->background_color_firgure_grid }};
        }

        .border-horizontal
        {
            height: {{ $frameType->container_border_space }}mm;
        }

        .border-vertical
        {
            width: {{ $frameType->container_border_space }}mm;
        }

        table.page.figures-grid td.figure-container
        {
            text-align: center;
            padding: {{ $frameType->space_between_figures }}mm;
        }

        table.page.figures-grid-bg td.figure-container
        {
            position: relative;
            text-align: center;
            padding: {{ $frameType->space_between_figures }}mm;
        }

        table.page.figures-grid-bg .figure-bg-num
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
    <table class="page figures-grid">
        <tbody>
            <tr>
                <td>&nbsp;</td>
                <td colspan="{{ $frameType->quantity_figures_by_row + 4 }}">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td rowspan="{{ $frameType->quantity_rows_by_page + 4 }}">&nbsp;</td>
                <td style="width: 5mm; height: 5mm;">&nbsp;</td>
                <td class="cut-horizontal-mark">&nbsp;</td>
                @for ($i = $frameType->quantity_figures_by_row; $i > 0; $i--)
                <td class="cut-horizontal-mark">&nbsp;</td>
                @endfor
                <td class="cut-horizontal-mark">&nbsp;</td>
                <td style="width: 5mm; height: 5mm;">&nbsp;</td>
                <td rowspan="{{ $frameType->quantity_rows_by_page + 4 }}">&nbsp;</td>
            </tr>
            <tr>
                <td class="cut-vertical-mark">&nbsp;</td>
                <td class="border-corner">&nbsp;</td>
                @for ($i = $frameType->quantity_figures_by_row; $i > 0; $i--)
                <td class="border-horizontal">&nbsp;</td>
                @endfor
                <td class="border-corner">&nbsp;</td>
                <td class="cut-vertical-mark">&nbsp;</td>
            </tr>
            @foreach ($page as $row)
            <tr>
                <td class="cut-vertical-mark">&nbsp;</td>
                <td class="border-vertical">&nbsp;</td>
                @foreach ($row as $k => $figure)
                <td class="figure-container">
                    <img src="{{ $figure['path'] }}" style="width: {{ $frameType->width }}mm;
                    height: {{ $frameType->height }}mm;"/>
                </td>
                @endforeach
                <td class="border-vertical">&nbsp;</td>
                <td class="cut-vertical-mark">&nbsp;</td>
            </tr>
            @endforeach
            <tr>
                <td class="cut-vertical-mark">&nbsp;</td>
                <td class="border-corner">&nbsp;</td>
                @for ($i = $frameType->quantity_figures_by_row; $i > 0; $i--)
                <td class="border-horizontal">&nbsp;</td>
                @endfor
                <td class="border-corner">&nbsp;</td>
                <td class="cut-vertical-mark">&nbsp;</td>
            </tr>
            <tr>
                <td style="width: 5mm; height: 5mm;">&nbsp;</td>
                <td class="cut-horizontal-mark">&nbsp;</td>
                @for ($i = $frameType->quantity_figures_by_row; $i > 0; $i--)
                <td class="cut-horizontal-mark">&nbsp;</td>
                @endfor
                <td class="cut-horizontal-mark">&nbsp;</td>
                <td style="width: 5mm; height: 5mm;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="{{ $frameType->quantity_figures_by_row + 4 }}">&nbsp;</td>
            </tr>
        </tbody>
    </table>

    <table class="page figures-grid-bg">
        <tbody>
            <tr>
                <td>&nbsp;</td>
                <td colspan="{{ $frameType->quantity_figures_by_row + 4 }}">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td rowspan="{{ $frameType->quantity_rows_by_page + 4 }}">&nbsp;</td>
                <td style="width: 5mm; height: 5mm;">&nbsp;</td>
                <td class="cut-horizontal-mark">&nbsp;</td>
                @for ($i = $frameType->quantity_figures_by_row; $i > 0; $i--)
                <td class="cut-horizontal-mark">&nbsp;</td>
                @endfor
                <td class="cut-horizontal-mark">&nbsp;</td>
                <td style="width: 5mm; height: 5mm;">&nbsp;</td>
                <td rowspan="{{ $frameType->quantity_rows_by_page + 4 }}">&nbsp;</td>
            </tr>
            <tr>
                <td class="cut-vertical-mark">&nbsp;</td>
                <td class="border-corner">&nbsp;</td>
                @for ($i = $frameType->quantity_figures_by_row; $i > 0; $i--)
                <td class="border-horizontal">&nbsp;</td>
                @endfor
                <td class="border-corner">&nbsp;</td>
                <td class="cut-vertical-mark">&nbsp;</td>
            </tr>
            @foreach ($page as $row)
            <tr>
                <td class="cut-vertical-mark">&nbsp;</td>
                <td class="border-vertical">&nbsp;</td>
                @foreach (array_reverse($row) as $k => $figure)
                <td class="figure-container">
                    <img src="{{ public_path($frameType->image_path) }}" style="width: {{ $frameType->width }}mm;
                    height: {{ $frameType->height }}mm;"/>
                    <p class="figure-bg-num" style="top: {{ $frameType->y_position }}mm;
                    left: {{ $frameType->x_position }}mm;
                    font-size: {{ $frameType->font_size }}pt;
                    font-family: '{{ $frameType->font->title }}';">
                        @if (substr_count($figure['sequence'], "1") > 0)
                            {!! '<span class="space">'.$figure['sequence'].'</span>' !!}
                        @else
                            {{ $figure['sequence'] }}
                        @endif
                    </p>
                </td>
                @endforeach
                <td class="border-vertical">&nbsp;</td>
                <td class="cut-vertical-mark">&nbsp;</td>
            </tr>
            @endforeach
            <tr>
                <td class="cut-vertical-mark">&nbsp;</td>
                <td class="border-corner">&nbsp;</td>
                @for ($i = $frameType->quantity_figures_by_row; $i > 0; $i--)
                <td class="border-horizontal">&nbsp;</td>
                @endfor
                <td class="border-corner">&nbsp;</td>
                <td class="cut-vertical-mark">&nbsp;</td>
            </tr>
            <tr>
                <td style="width: 5mm; height: 5mm;">&nbsp;</td>
                <td class="cut-horizontal-mark">&nbsp;</td>
                @for ($i = $frameType->quantity_figures_by_row; $i > 0; $i--)
                <td class="cut-horizontal-mark">&nbsp;</td>
                @endfor
                <td class="cut-horizontal-mark">&nbsp;</td>
                <td style="width: 5mm; height: 5mm;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="{{ $frameType->quantity_figures_by_row + 4 }}">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    @endforeach
</body>
</html>
