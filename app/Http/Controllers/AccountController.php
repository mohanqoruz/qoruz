<?php

namespace App\Http\Controllers;

use App\Users\Models\User as User;
use App\Accounts\Models\Account as Account;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
}

