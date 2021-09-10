<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Tier extends Enum
{
    public const CHALLENGER = 9;
    public const GRANDMASTER = 8;
    public const MASTER = 7;
    public const DIAMOND = 6;
    public const PLATINUM = 5;
    public const GOLD = 4;
    public const SILVER = 3;
    public const BRONZE = 2;
    public const IRON = 1;
}
