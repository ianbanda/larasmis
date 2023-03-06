<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authentication extends Controller
{
    //
    public function index()
    {
        self::loginScreen();
    }

    public function loginScreen()
    {
        return view('authentication.login');
    }
}
