<?php

use App\Routers\Router;
use App\Controllers\ProductController;

$router = new Router;

$router->get('/', [ProductController::class, 'index'])
    ->get('/add-product', [ProductController::class, 'create']);

// APIs
$router->post('/product-store', [ProductController::class, 'store'])
    ->post('/product-mass-delete', [ProductController::class, 'massDelete']);
