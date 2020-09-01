<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        @foreach ($fonts as $font)
        {!! "@font-face {font-family: '".$font->title."'; src: url('".public_path($font->path)."');}" !!}
        @endforeach

        @page
        {
            size: {{ $album->printPageType->width }}mm {{ $album->printPageType->height }}mm;
        }

        html,
        body
        {
            margin: 0px;
            padding: 0px;
            width: {{ $album->printPageType->width }}mm;
            height: {{ $album->printPageType->height }}mm;
        }

        table.page
        {
            border: none;
            border-spacing: 0px;
            width: 100%;
            height: 100%;
            page-break-after: always;
            padding: 0px;
            margin: 0px;
        }

        table.page tr,
        table.page td
        {
            padding: 0px;
            margin: 0px;
        }

        table.page .content
        {
            width: {{ $album->presentationPageType->width }}mm;
            height: {{ $album->presentationPageType->height }}mm;
        }

        table.page .content .album-page-image
        {
            position: relative;
            width: 100%;
            height: 100%;
            margin: 0px;
        }

        table.page .content .background
        {
            position: fixed;
            margin: 0px;
            padding: 0px;
            display: grid;
        }

        table.page .content .text
        {
            position: fixed;
            margin: 0px;
            padding: 0px;
        }

        table.page .content .text p
        {
            margin: 0px;
            padding: 0px;
        }

        .left-right-cut
        {
            border-left: 1px solid black;
            border-right: 1px solid black;
            height: 5mm;
            width: inherit;
            margin-left: {{ $album->print_cut_space }}mm;
            margin-right: {{ $album->print_cut_space }}mm;
        }

        .top-bottom-cut
        {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width:  5mm;
            height: {{ ($album->presentationPageType->height - (2 * $album->print_cut_space)) }}mm;
            margin-top: {{ $album->print_cut_space }}mm;
            margin-bottom: {{ $album->print_cut_space }}mm;
        }

        .right-container .top-bottom-cut
        {
            margin-left: auto;
        }

        .bottom-container .left-right-cut
        {
            position: fixed;
            bottom: 0;
            margin-left: {{ $marginWidth + $album->print_cut_space }}mm;
            margin-right: {{ $marginWidth + $album->print_cut_space }}mm;
        }

        .space-holder
        {
            height: 5mm;
            width: inherit;
        }
    </style>
</head>
<body>
    @foreach ($album->pages as $page)
        <table class="page">
            <tr>
                <td></td>
                <td class="cut-container">
                    <div class="left-right-cut"></div>
                </td>
                <td></td>
            </tr>
            <tr class="container">
                <td class="cut-container">
                    <div class="top-bottom-cut"></div>
                </td>
                <td class="content">
                    @if (count($page->backgrounds) > 0 && array_key_exists($page->id, $backgrounds))
                        @foreach ($backgrounds[$page->id] as $k => $v)
                            <img src="{{ $v['path'] }}" class="background" style="
                            left: {{ $v['x_position'] }}mm;
                            top: {{ $v['y_position'] }}mm;
                            transform: rotate({{ $v['rotation'] }}deg);
                            width: {{ $v['width'] }}mm;
                            height: {{ $v['height'] }}mm;"/>
                        @endforeach
                    @endif
                    <img src="{{ public_path($page->image_path) }}" class="album-page-image"/>
                    @if (count($page->texts) > 0 && array_key_exists($page->id, $texts))
                        @foreach ($texts[$page->id] as $k => $v)
                            <div class="text" style="
                            width: {{ $v['width'] }}mm;
                            left: {{ $v['x_position'] }}mm;
                            top: {{ $v['y_position'] }}mm;
                            transform: rotate({{ $v['rotation'] }}deg);">
                                <p style="color: {{ $v['color'] }};
                                text-align: {{ $v['alignment'] }};
                                font-size: {{ $v['font_size'] }}pt;
                                font-family: {{ $v['font_family'] }};">
                                    {{ $v['text'] }}
                                </p>
                            </div>
                        @endforeach
                    @endif
                </td>
                <td class="cut-container right-container">
                    <div class="top-bottom-cut"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="cut-container bottom-container">
                    <div class="space-holder"></div>
                    <div class="left-right-cut"></div>
                </td>
                <td></td>
            </tr>
        </table>
    @endforeach
</body>
</html>
