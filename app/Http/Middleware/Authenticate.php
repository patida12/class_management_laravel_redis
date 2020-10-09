<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\LoginController;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function redirectTo($request)
    {
        // if (! Auth::check()) {
        //     // dd("chua login");
        //     return redirect('/login');
        //     // return redirect()->action([LoginController::class,'getLogin']);
        // }
        return action([LoginController::class,'getLogin']);
    }
}
