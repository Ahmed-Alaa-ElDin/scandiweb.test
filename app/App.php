<?php

namespace App;

use App\DB\DB;
use App\Routers\Router;

class App
{
    private static DB $db;

    public function __construct(protected Router $router, protected array $request, protected array $config)
    {
        static::$db = new DB($config);
    }

    public static function db(): DB
    {
        return static::$db;
    }

    public function run()
    {
        echo $this->router->resolve($this->request['uri'], $_SERVER['REQUEST_METHOD']);
    }
}
