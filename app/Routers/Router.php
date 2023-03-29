<?php

namespace App\Routers;

use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes = [];

    public function register(string $route, callable|array $action): self
    {
        $this->routes[$route] = $action;

        return $this;
    }

    public function resolve(string $url)
    {
        $route = explode('?', $url);
        $action = $this->routes[$route[0]] ?? null;

        if (is_callable($action)) {
            return $action();
        }

        if (is_array($action)) {
            [$class, $method] = $action;

            if(class_exists($class)) {
                $class = new $class;

                if (method_exists($class,$method)) {
                    return call_user_func_array([$class,$method],[]);
                }
            }
        }

        if (!$action) {
            throw  new RouteNotFoundException();
        }
    }
}
