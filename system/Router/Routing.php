<?php

namespace System\Router;

use System\Config\Config;

class Routing
{
  // private $current_route;
  private $reserveRoute;
  private $method_field;
  private $routes;
  private $values = [];

  public function __construct()
  {
    global $routes;
    $this->routes = $routes;
    $this->method_field = $this->methodField();
    $this->reserveRoute = $this->findRoute(Config::get('app.CURRENT_ROUTE'));
  }

  public function findRoute($currentRoute)
  {
    $currentRoute = substr($currentRoute, 0, 1) ===  "/" ? substr($currentRoute, 1) : $currentRoute;
    foreach ($this->routes[$this->method_field] as $route) {
      $routeRes = substr($route['url'], 0, 1) ===  "/" ? substr($route['url'], 1) : $route['url'];
      if ($this->regexMatched($currentRoute,   $routeRes)) {
        return $route;
      }
    }
  }
  public function regexMatched($currentRoute, $route)
  {
    $route_pattern = preg_replace('/\//', '\\/', $route);

    $route_pattern = preg_replace('/\{\?*([a-z]+)\}/', '(?<\1>[a-z0-9-]+)', $route_pattern);

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
      $this->error404();
    }
    $this->dispatch($this->reserveRoute);
  }


  private function dispatch($route)
  {
    $action = $route['action'];
    if (is_null($action) || empty($action)) {
      return;
    }

    if (is_callable($action)) {
      $result = $action();
      if ($result != null)
        var_dump($action());
    }

    if (is_string($action)) {
      $action = list($controller, $method) = explode('@', $action);
    }
    if (is_array($action)) {
      if (file_exists(Config::get('app.BASE_DIR') . "/app/Http/Controllers/$controller.php")) {
        $controller = '\App\Http\Controllers\\' . $controller;
        $object = new  $controller();
        if (method_exists($object, $method)) {
          call_user_func_array([$object, $method], $this->values);
        } else {
          $this->error404();
        }
      } else {
        $this->error404();
      }
    }
  }
  public function error404()
  {

    http_response_code(404);
    include __DIR__ . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . '404.php';
    exit;
  }

  public function methodField()
  {

    $method_field = strtolower($_SERVER['REQUEST_METHOD']);

    if ($method_field == 'post') {

      if (isset($_POST['_method'])) {

        if ($_POST['_method'] == 'put') {
          $method_field = 'put';
        } elseif ($_POST['_method'] == 'delete') {
          $method_field = 'delete';
        }
      }
    }
    return $method_field;
  }
}
