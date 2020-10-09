<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function getLogin()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');


        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home');
        } else
        {
            return redirect()->action([LoginController::class,'getLogin'])->with('error', 'Username or password is incorrect!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->action([LoginController::class,'getLogin']);
    }
}
