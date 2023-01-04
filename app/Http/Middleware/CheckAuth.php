<?php

namespace App\Http\Middleware;

use System\Auth\Auth;
use System\Middleware\Middleware;

class CheckAuth extends Middleware
{
    public function handle()
    {
        Auth::check();
    }
}
 