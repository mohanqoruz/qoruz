<?php

namespace App\Subscriptions\Exceptions;

use InvalidArgumentException;

class PricingDoesNotExist extends InvalidArgumentException
{

    /**
     * Role not found exception
     *
     * @throws \InvalidArgumentException
     */
    public static function create(string $priceName)
    {
        return new static("There is no Pricing named `{$priceName}`.");
    }
}
