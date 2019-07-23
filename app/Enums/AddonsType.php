<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AddonsType extends Enum
{
    const Plan = 'plans';
    const Brand = 'brands';
    const User = 'users';
    const Report = 'reports';
    const Profile = 'profiles';
}
