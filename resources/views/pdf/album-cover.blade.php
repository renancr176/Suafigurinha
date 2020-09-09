<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        /* @foreach ($fonts as $font)
        {!! "@font-face {font-family: '".$font->title."'; src: url('".public_path($font->path)."');}" !!}
        @endforeach */

        @page
        {
            size: {{ $album->printCoverPageType->width }}mm {{ $album->printCoverPageType->height }}mm;
        }

        html,
        body
        {
            margin: 0px;
            padding: 0px;
            width: {{ $album->printCoverPageType->width }}mm;
            height: {{ $album->printCoverPageType->height }}mm;
        }

        table
        {
            border: none;
            border-spacing: 0px;
            padding: 0px;
            margin: 0px;
        }

        table tr,
        table td
        {
            padding: 0px;
            margin: 0px;
        }

        .top-bottom-cut-container
        {
            padding: {{ $externalCutsHeight }}mm 0mm {{ $externalCutsHeight }}mm 0mm;
        }

        .top-bottom-cut
        {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            width:  {{ $externalCutsWidth }}mm;
            height: {{ floor($album->printCoverPageType->height - (2 * $externalCutsHeight)) - 2 }}mm;
        }

        .left-cut
        {
            border-left: 1px solid black;
            height: {{ $externalCutsHeight }}mm;
        }

        .right-cut
        {
            border-right: 1px solid black;
            height: {{ $externalCutsHeight }}mm;
        }

        .middle-cut
        {
            border-right: 1px solid black;
            height: {{ floor($middleCutRowHight) }}mm;
        }

        .page
        {
            width: 100%;
        }

        .bg-color
        {
            background-color: chartreuse;
        }

        .content
        {
            width: {{ $album->presentationCoverPageType->width + $album->print_cut_space }}mm;
            height: {{ $album->presentationCoverPageType->height + $album->print_cut_space }}mm;
        }

        .content img
        {
            width: 100%;
            height: 100%;
            margin: 0px;
        }

        .content .background
        {
            position: fixed;
            margin: 0px;
            padding: 0px;
            display: grid;
        }

        .content .text
        {
            position: fixed;
            margin: 0px;
            padding: 0px;
        }

        .content .text p
        {
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>
<body>
    <table class="page">
        <tr>
            <td class="top-bottom-cut-container">
                <div class="top-bottom-cut">&nbsp;</div>
            </td>
            <td>
                <table>
                    <tr>
                        <td class="left-cut">&nbsp;</td>
                        <td class="right-cut">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="middle-cut">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr class="bg-color">
                        <td class="content">
                            @if (count($backCover->albumPage()->first()->backgrounds()->get()) > 0 && array_key_exists($backCover->albumPage()->first()->id, $backgrounds))
                                @foreach ($backgrounds[$backCover->albumPage()->first()->id] as $k => $v)
                                    <img src="{{ $v['path'] }}" class="background" style="
                                    left: {{ $v['x_position'] + $diffPresentationPagesWidth }}mm;
                                    top: {{ $v['y_position'] + $diffPresentationPagesHeight }}mm;
                                    transform: rotate({{ $v['rotation'] }}deg);
                                    width: {{ $v['width'] }}mm;
                                    height: {{ $v['height'] }}mm;"/>
                                @endforeach
                            @endif
                            <img src="{{ public_path($backCover->image_path) }}" class="album-page-image"/>
                            @if (count($backCover->albumPage()->first()->texts()->get()) > 0 && array_key_exists($backCover->albumPage()->first()->id, $texts))
                                @foreach ($texts[$backCover->albumPage()->first()->id] as $k => $v)
                                    <div class="text" style="
                                    width: {{ $v['width'] }}mm;
                                    left: {{ $v['x_position'] + $diffPresentationPagesWidth }}mm;
                                    top: {{ $v['y_position'] + $diffPresentationPagesHeight }}mm;
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
                        <td class="content">
                            @if (count($frontCover->albumPage()->first()->backgrounds()->get()) > 0 && array_key_exists($frontCover->albumPage()->first()->id, $backgrounds))
                                @foreach ($backgrounds[$frontCover->albumPage()->first()->id] as $k => $v)
                                    <img src="{{ $v['path'] }}" class="background" style="
                                    left: {{ $v['x_position'] + $diffPresentationPagesWidth + $album->presentationCoverPageType->width + $album->print_cut_space }}mm;
                                    top: {{ $v['y_position'] + $diffPresentationPagesHeight }}mm;
                                    transform: rotate({{ $v['rotation'] }}deg);
                                    width: {{ $v['width'] }}mm;
                                    height: {{ $v['height'] }}mm;"/>
                                @endforeach
                            @endif
                            <img src="{{ public_path($frontCover->image_path) }}" class="album-page-image"/>
                            @if (count($frontCover->albumPage()->first()->texts()->get()) > 0 && array_key_exists($frontCover->albumPage()->first()->id, $texts))
                                @foreach ($texts[$frontCover->albumPage()->first()->id] as $k => $v)
                                    <div class="text" style="
                                    width: {{ $v['width'] }}mm;
                                    left: {{ $v['x_position'] + $diffPresentationPagesWidth + $album->presentationCoverPageType->width + $album->print_cut_space }}mm;
                                    top: {{ $v['y_position'] + $diffPresentationPagesHeight }}mm;
                                    transform: rotate({{ $v['rotation'] }}deg);">
                                        <p style="color: {{ $v['color'] }};
                                        text-align: {{ $v['alignment'] }};
                                        font-size: {{ $v['font_size'] }}pt;">
                                        {{-- font-family: {{ $v['font_family'] }}; --}}
                                            {{ $v['text'] }}
                                        </p>
                                    </div>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="middle-cut">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="left-cut">&nbsp;</td>
                        <td class="right-cut">&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td class="top-bottom-cut-container">
                <div class="top-bottom-cut">&nbsp;</div>
            </td>
        </tr>
    </table>
</body>
</html>
