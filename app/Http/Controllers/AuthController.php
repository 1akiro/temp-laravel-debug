<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegister ()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

     public function register ()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }
}
