<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Figure()
 * @method static static Background()
 * @method static static Album()
 * @method static static FigureGrid()
 */
final class AlbumOrderFileTypeEnum extends Enum
{
    const Figure = 1;
    const Background = 2;
    const Album = 3;
    const FigureGrid = 4;
    const Cover = 5;
}
