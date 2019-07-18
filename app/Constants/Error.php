<?php

namespace App\Constants;

use Illuminate\Support\Facades\Facade;

class Error  extends Facade {

    /**
     * Constant representing an validation failed.
     *
     * @var string
     */
    const VALIDATION_FAILED = 'validation_failed';

    /**
     * Constant representing an unauthendicate.
     *
     * @var string
     */
    const NOT_AUTHED = 'not_authed';

    /**
     * Constant representing an wrong credentials.
     *
     * @var string
     */
    const WRONG_CREDENTIALS = 'wrong_credentials';

    /**
     * Constant representing an already email verified
     *
     * @var string
     */
    const ALREADY_VERIFIED = 'already_verified';

    /**
     * Constant representing an user not found
     *
     * @var string
     */
    const USER_NOT_FOUND = 'user_not_found';

    /**
     * Constant representing an invalid token
     *
     * @var string
     */
    const INVALID_TOKEN = 'invalid_token';

    /**
     * Constant representing an wrong old password
     *
     * @var string
     */
    const OLD_PASSWORD_WRONG = 'old_password_wrong';

    /**
     * Constant representing an unauthorized
     *
     * @var string
     */
    const NO_PERMISSION = 'no_permission';


    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'error';
    }
}