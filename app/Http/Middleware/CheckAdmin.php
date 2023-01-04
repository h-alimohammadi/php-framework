<?php

namespace App\Http\Middleware;

use System\Auth\Auth;
use System\Middleware\Middleware;

class CheckAdmin extends Middleware
{
    public function handle()
    {
        if(Auth::user()->user_type != 'admin'){
            redirect('/');
        }
    }
}
 