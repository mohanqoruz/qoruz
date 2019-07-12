<?php

namespace App\Role\Exceptions;

use InvalidArgumentException;

class PlanDoesNotExist extends InvalidArgumentException
{

    /**
     * Role not found exception
     *
     * @throws \InvalidArgumentException
     */
    public static function create(string $planName)
    {
        return new static("There is no plan named `{$planName}`.");
    }
}
