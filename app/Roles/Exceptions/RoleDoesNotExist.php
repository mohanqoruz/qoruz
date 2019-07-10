<?php

namespace App\Role\Exceptions;

use InvalidArgumentException;

class RoleDoesNotExist extends InvalidArgumentException
{

    /**
     * Role not found exception
     *
     * @throws \InvalidArgumentException
     */
    public static function create(string $roleName)
    {
        return new static("There is no role named `{$roleName}`.");
    }
}
