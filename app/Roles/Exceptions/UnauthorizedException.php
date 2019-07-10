<?php

namespace App\Roles\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedException extends HttpException
{
    /**
     * Role not found exception
     *
     * @throws HttpException
     */
    public static function forRole($role): self
    {
        return new static(403, 'User does not have the right roles.', null, []);
    }

    /**
     * Role not found exception
     *
     * @throws HttpException
     */
    public static function notLoggedIn(): self
    {
        return new static(403, 'User is not logged in.', null, []);
    }
}
