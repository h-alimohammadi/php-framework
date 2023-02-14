<?php

namespace System\Router;

use PHPMailer\PHPMailer\Exception;
use System\Config\Config;
use System\Middleware\MiddlewareRoute;

class Routing
{
  private $reserveRoute;
  private $method_field;
  private $routes;
  private $values = [];

  public function __construct()
  {
    global $routes;
    $this->routes = $routes;
    $_method = isset($_POST['_method']) ? $_POST['_method'] : '';
    $this->method_field = $this->setMethodRequest($_method, strtolower($_SERVER['REQUEST_METHOD']));
    $this->reserveRoute = $this->findRoute(Config::get('app.CURRENT_ROUTE'));
    $this->runMiddleware();
  }

  private function runMiddleware()
  {
    $midllewares = $this->reserveRoute['options']['middleware'] ?? null;
    MiddlewareRoute::runMiddlewareRoute($midllewares);
  }

  public function findRoute($currentRoute)
  {
    $currentRoute = substr($currentRoute, 0, 1) ===  "/" ? substr($currentRoute, 1) : $currentRoute;
    foreach ($this->routes[$this->method_field] as $route) {
      $routeRes = substr($route['url'], 0, 1) ===  "/" ? substr($route['url'], 1) : $route['url'];
      if ($this->regexMatchedRoute($currentRoute,   $routeRes)) {
        return $route;
      }
    }
  }
  public function regexMatchedRoute($currentRoute, $route)
  {
    $route_pattern = preg_replace('/\//', '\\/', $route);

    $route_pattern = preg_replace('/\{\?*([a-z_]+)\}/', '(?<\1>[a-z0-9-]+)', $route_pattern);

    $route_pattern = '/^' . $route_pattern . '\/?$/i';

    $res = preg_match($route_pattern, $currentRoute, $matches);
    if ($res) {
      foreach ($matches as $key => $matche) {
        if (is_string($key)) {
          $this->values[$key] = $matche;
        }
      }
      return true;
    } else {
      return false;
    }
    return true;
  }

  public function run()
  {
    if (is_null($this->reserveRoute)) {
      throw new Exception("route not found", 404);
    }
    $this->dispatch($this->reserveRoute);
  }


  private function dispatch($route)
  {
    $action = $route['action'];

    if (is_null($action) || empty($action)) {
      throw new Exception("action route is null ", 404);
    }

    if (is_callable($action)) {
      $result = $action();
      if ($result != null)
        var_dump($action());
    }

    if (is_string($action)) {
      $action = list($controller, $method) = explode('@', $action);
    }

    if (!is_array($action)) {
      throw new Exception("action {$action} is not array", 404);
    }

    if (!file_exists(Config::get('app.BASE_DIR') . "/app/Http/Controllers/$controller.php")) {
      throw new Exception("method {$controller} not found", 404);
    }

    $controller = '\App\Http\Controllers\\' . $controller;
    $object = new  $controller();

    if (!method_exists($object, $method)) {
      throw new Exception("method {$method} not found", 404);
    }
    $result = call_user_func_array([$object, $method], $this->values);
    echo '<pre>';
    print_r($result);
  }

  public function setMethodRequest($_method, $requestMethod)
  {
    if ($requestMethod != 'post') {
      $requestMethod = 'get';
    }
    if ($_method == 'put') {
      $requestMethod = 'put';
    } elseif ($_method == 'delete') {
      $requestMethod = 'delete';
    }


    return $requestMethod;
  }
}
