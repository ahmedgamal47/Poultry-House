<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const PENDING = 5;
    const IN_PROGRESS = 10;
    const FINISHED = 15;
    const CANCELED = 20;
}
