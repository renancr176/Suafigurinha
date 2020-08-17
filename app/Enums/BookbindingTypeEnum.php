<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static SaddleStitching()
 * @method static static Pasting()
 */
final class BookbindingTypeEnum extends Enum
{
    const SaddleStitching = 1;
    const Pasting = 2;
}
