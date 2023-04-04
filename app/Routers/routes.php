<?php

use App\Controllers\ProductController;
use App\Routers\Router;

$router = new Router;

$router->get('/', [ProductController::class, 'index'])
    ->get('/add-product', [ProductController::class, 'create'])
    ->post('/add-product', [ProductController::class, 'store']);


$router->post('/product-validation',[ProductController::class,'validate']);