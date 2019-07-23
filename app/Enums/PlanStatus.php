<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PlanStatus extends Enum
{
    const Active = 'active';
    const Inactive = 'inactive';
    const Suspended = 'suspended';
}
