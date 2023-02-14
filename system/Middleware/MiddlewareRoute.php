<?php

namespace System\Middleware;

class MiddlewareRoute 
{
  
  public static function handle($midllewares)
  {
    if (!is_null($midllewares)) {
      if (!is_array($midllewares)) {
        $obj = new  $midllewares();
        $result = $obj->handle();
        if ($result != null)
          var_dump($result);
      }
      if (is_array($midllewares)) {
        foreach ($midllewares as $middlewareClass) {
          $obj = new  $middlewareClass();
          $obj->handle();
        }
      }
    }
  }
<<<<<<< Updated upstream
=======
  public static function runMiddlewareRoute($midllewares)
  {
    if (!is_null($midllewares)) {
      if (!is_array($midllewares)) {
        $obj = new  $midllewares();
        $result = $obj->handle();
        if ($result != null)
          var_dump($result);
      }
      if (is_array($midllewares)) {
        foreach ($midllewares as $middlewareClass) {
          $obj = new  $middlewareClass();
          $obj->handle();
        }
      }
    }
  }
>>>>>>> Stashed changes

}
