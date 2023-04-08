<?php

namespace App\Controllers;

use App\Views\View;
use App\Models\DVD\DVD;
use App\Models\Book\Book;
use App\Models\Product\Product;
use App\Models\Furniture\Furniture;

class ProductController
{
    public function index(): string
    {
        $products = Product::all();

        return View::make('products/index', ["products" => $products])->render();
    }

    public function create()
    {
        return View::make('products/create')->render();
    }

    public function store()
    {
        $className = "App\\Models\\" . $_POST['type'] . "\\" . $_POST['type'];

        if (!empty($_POST['type']) && class_exists($className)) {

            $errors = $className::validate($_POST);

            if (empty($errors)) {
                $product = new $className(
                    null,
                    $_POST['sku'],
                    $_POST['name'],
                    $_POST['price'],
                    $_POST['arguments']
                );

                return $product->create() ? json_encode([
                    "status" => 'success',
                    "messages" => 'Product has been created successfully'
                ]) : json_encode([
                    "status" => 'failed',
                    "messages" => "Product hasn't been created"
                ]);
            } else {
                return json_encode([
                    "status" => 'failed',
                    "messages" => $errors
                ]);
            }
        } else {
            return json_encode([
                "status" => 'failed',
                "messages" => [
                    'type' => ['Please Choose the Correct Type of the Product']
                ]
            ]);
        }
    }

    public function massDelete()
    {
        if (!empty($_POST['selectedProducts']) && Product::massDelete($_POST['selectedProducts'])) {
            return json_encode([
                "status" => 'success',
                "messages" => [
                    'Products have been deleted'
                ]
            ]);
        } else {
            return json_encode([
                "status" => 'failed',
                "messages" => [
                    'Products have not been deleted'
                ]
            ]);
        }
    }
}
