<?php

namespace System\Middleware;

use System\Middleware\Contract\MiddlewareInterface;

abstract class Middleware implements MiddlewareInterface{
    private $middleware ;
    public function __construct()
    {
        $this->readMiddleware();
    }

    private function readMiddleware(){
        //code
    }
    
}