<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // function to auth login
    public function authLogin()
    {
        return view('back-end.auth.login');
    }

    // function to auth register
    public function authRegistration()
    {
        return view('back-end.auth.registration');
    }
}
