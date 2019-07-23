<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AccountStatus extends Enum
{
    const Trialing = 'trialing';
    const Active = 'active';
    const Suspended = 'suspended';
    const Deleted = 'deleted';
}
