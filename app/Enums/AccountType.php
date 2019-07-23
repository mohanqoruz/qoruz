<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AccountType extends Enum
{
    const Brand = 'brand';
    const Agency = 'agency';
    const API = 'api';
    const WhiteLabel = 'whitelabel';
    const Startup = 'startup';
}