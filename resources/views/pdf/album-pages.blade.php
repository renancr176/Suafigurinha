<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        @foreach ($fonts as $font)
        {!! "@font-face {font-family: '".$font->title."'; src: url('".public_path($font->path)."');}" !!}
        @endforeach

        html,
        body
        {
            margin: 0px;
            padding: 0px;
        }

        .page
        {
            width: 100%;
            page-break-after: always;
        }

        .page:last-child
        {
            page-break-after: avoid;
        }

        .page .album-page-image
        {
            width: 100%;
            position: fixed;
        }

        .page .background,
        {
            position: fixed;
            margin: 0px;
            padding: 0px;
            display: grid;
        }

        .page .text
        {
            position: fixed;
            margin: 0px;
            padding: 0px;
        }

        .page .text p
        {
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>
<body style="width: {{ $album->presentationPageType->width }}mm;">
    @foreach ($album->pages as $page)
    <div class="page">
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
    </div>
    @endforeach
</body>
</html>
