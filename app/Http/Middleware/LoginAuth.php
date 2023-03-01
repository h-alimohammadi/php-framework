<?php

namespace App\Http\Middleware;

use System\Auth\Auth;
use System\Middleware\Middleware;

class LoginAuth extends Middleware
{
    public function handle()
    {
        if(Auth::check()){
            // die('mmmmmmm');
            return redirect('/');
        }
    }
}
 