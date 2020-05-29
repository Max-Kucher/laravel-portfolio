<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ACTIVE()
 * @method static static HIDDEN()
 * @method static static DISABLE()
 */
final class Status extends Enum
{
    const ACTIVE = 'A';
    const HIDDEN = 'H';
    const DISABLE = 'D';
}
