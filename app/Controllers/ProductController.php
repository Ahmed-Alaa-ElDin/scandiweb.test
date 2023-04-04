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

    public function validate()
    {
        if (isset($_POST['productType']) && in_array($_POST['productType'], [1, 2, 3])) {

            switch ($_POST['productType']) {
                case '1':
                    $errors = DVD::validate($_POST);
                    if (empty($errors) && DVD::create($_POST['sku'], $_POST['name'], $_POST['price'], $_POST['size'])) {
                        return json_encode([
                            "status" => 'success',
                            "messages" => 'Product created successfully'
                        ]);
                    } else {
                        return json_encode([
                            "status" => 'failed',
                            "messages" => $errors
                        ]);
                    }

                case '2':
                    $errors = Book::validate($_POST);
                    if (empty($errors) && Book::create($_POST['sku'], $_POST['name'], $_POST['price'], $_POST['weight'])) {
                        return json_encode([
                            "status" => 'success',
                            "messages" => 'Product created successfully'
                        ]);
                    } else {
                        return json_encode([
                            "status" => 'failed',
                            "messages" => $errors
                        ]);
                    }

                case '3':
                    $errors = Furniture::validate($_POST);
                    if (empty($errors) && Furniture::create($_POST['sku'], $_POST['name'], $_POST['price'], $_POST['height'], $_POST['width'], $_POST['length'])) {
                        return json_encode([
                            "status" => 'success',
                            "messages" => 'Product created successfully'
                        ]);
                    } else {
                        return json_encode([
                            "status" => 'failed',
                            "messages" => $errors
                        ]);
                    }

                default:
                    return json_encode([
                        "status" => 'failed',
                        "messages" => [
                            'productType' => ['Please Choose the Correct Type of the Product']
                        ]
                    ]);
            }
        } else {
            return json_encode([
                "status" => 'failed',
                "messages" => [
                    'productType' => ['Please Choose the Correct Type of the Product']
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
