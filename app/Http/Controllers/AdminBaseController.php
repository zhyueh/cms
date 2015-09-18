<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class AdminBaseController extends Controller
{

    public function __construct()
    {
        if (Auth::check())
        {
            view()->share('login_user', Auth::user());
        }


        parent::__construct();
    }

}
