<?php

namespace App\Routers;

use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes = [];

    public function register(string $method, string $route, callable|array $action): self
    {
        $this->routes[$method][$route] = $action;

        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register('GET', $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register('POST', $route, $action);
    }

    public function resolve(string $url, string $method)
    {
        $route = explode('?', $url)[0];
        $action = $this->routes[$method][$route] ?? null;

        if (is_callable($action)) {
            return $action();
        }

        if (is_array($action)) {
            [$class, $method] = $action;

            if (class_exists($class)) {
                $class = new $class;

                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }

        if (!$action) {
            throw  new RouteNotFoundException();
        }
    }
}
