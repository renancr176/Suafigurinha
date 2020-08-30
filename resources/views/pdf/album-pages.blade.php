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
        }

        table.page:last-child
        {
            page-break-after: avoid;
        }

        table.page td
        {
            padding: 0px;
        }

        table.page .content
        {
            width: {{ $album->presentationPageType->width }}mm;
            height: {{ $album->presentationPageType->height }}mm;
        }

        table.page .content .album-page-image
        {
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
    </style>
</head>
<body>
    @foreach ($album->pages as $page)
        <table class="page">
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
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
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @endforeach
</body>
</html>
