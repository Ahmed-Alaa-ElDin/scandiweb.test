<?php

use App\Routers\Router;
use App\Controllers\ProductController;

$router = new Router;

$router->get('/', [ProductController::class, 'index'])
    ->get('/add-product', [ProductController::class, 'create'])
    ->post('/add-product', [ProductController::class, 'store']);

// APIs
$router->post('/product-validation', [ProductController::class, 'validate'])
    ->post('/product-mass-delete', [ProductController::class, 'massDelete']);
