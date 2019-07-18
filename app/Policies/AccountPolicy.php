<?php

namespace App\Policies;

use App\Users\Models\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function createUser()
    {
        # code...
    }
}
