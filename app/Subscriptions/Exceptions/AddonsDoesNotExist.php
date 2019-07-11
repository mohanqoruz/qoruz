<?php

namespace App\Subscriptions\Exceptions;

use InvalidArgumentException;

class AddonsDoesNotExist extends InvalidArgumentException
{

    /**
     * Role not found exception
     *
     * @throws \InvalidArgumentException
     */
    public static function create(string $addonName)
    {
        return new static("There is no addon named `{$addonName}`.");
    }
}
