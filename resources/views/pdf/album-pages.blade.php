<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        @foreach ($fonts as $font)
        {!! "@font-face {font-family: '".$font->title."'; src: url('".$font->path."');}" !!}
        @endforeach 

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
        }

        .page .background,
        .page .text
        {
            position: fixed;
            margin: 0px;
            padding: 0px;
            display: grid;
        }
    </style>
</head>
<body style="width: {{ $album->pageType->width }}mm;">
    @foreach ($album->pages as $page)
    <div class="page">
        @if (count($page->backgrounds) > 0 && array_key_exists($page->id, $backgrounds))
            @foreach ($backgrounds[$album->pages->id] as $k => $v)
                <img src="{{ $v['path'] }}" class="background" style="
                left: {{ $v['x_position'] }}mm; 
                top: {{ $v['y_position'] }}mm; 
                transform: rotate({{ $v['rotation'] }}deg); 
                width: {{ $v['width'] }}mm; 
                height: {{ $v['height'] }}mm;"/>
            @endforeach
        @endif
        <img src="{{ $page->image_path }}" class="album-page-image"/>
        @if (count($page->texts) > 0 && array_key_exists($page->id, $texts))
            @foreach ($texts[$album->pages->id] as $k => $v)
                <div class="text" style="
                width: {{ $v['width'] }}mm;
                left: {{ $v['x_position'] }}mm;
                top: {{ $v['y_position'] }}mm;
                transform: rotate({{ $v['rotation'] }}deg);
                color: {{ $v['color'] }};
                text-align: {{ $v['alignment'] }};
                font-size: {{ $v['font_size'] }}pt;
                font-family: {{ $v['font_family'] }};">
                    {{ $v['text'] }}
                </div>
            @endforeach
        @endif
    </div>
    @endforeach
</body>
</html>
