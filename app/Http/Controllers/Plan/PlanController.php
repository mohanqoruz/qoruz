<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends Controller
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