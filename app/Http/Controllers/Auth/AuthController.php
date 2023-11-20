<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    // function to auth login
    public function authLogin(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                
                $request->session()->regenerate();
                return redirect()->route('admin_dashboard');
                
            } else {
                return redirect()->back()->with(
                    'error', 'Invalid credentials.'
                );
            }
        } else {
            // return
            return view('back-end.auth.login');
        }
        
    }

    // function to auth register
    public function authRegistration()
    {
        return view('back-end.auth.registration');
    }
    public function logout(){

        Session::flush();
        Auth::logout();
        return redirect()->route('auth_login');
    }
}
