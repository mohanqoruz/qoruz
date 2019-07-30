<?php

namespace App\Profiles\Exceptions;

use InvalidArgumentException;

class ProfileDoesNotExist extends InvalidArgumentException
{

    /**
     * Role not found exception
     *
     * @throws \InvalidArgumentException
     */
    public static function create($request)
    {
        $message = 'Profile id / handle not found';

        if ($request->has('profile_id')) {
            $message = "Profile id `{$request->profile_id}` not found";
        }

        if ($request->has('handle')) {
            $message = "Profile handle `{$request->handle}` not found";
        }
        
        return new static($message);
    }
}
