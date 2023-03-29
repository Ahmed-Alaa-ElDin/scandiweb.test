<?php

declare(strict_types=1);

use App\Controllers\ProductController;
use App\Routers\Router;

require __DIR__ . '/vendor/autoload.php';

// echo '<pre>';
//     print_r($_SERVER['REQUEST_URI']);
// echo '</pre>';

$router = new Router;

$router->register('/', [ProductController::class, 'index'])
    ->register('/products/create', [ProductController::class, 'create']);


$router->resolve($_SERVER['REQUEST_URI']);
