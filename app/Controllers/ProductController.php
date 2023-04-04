<?php

namespace App\Controllers;

use App\App;
use App\Models\Book\Book;
use App\Models\DVD\DVD;
use App\Models\Furniture\Furniture;
use App\Views\View;
use Exception;

class ProductController
{
    public function index(): string
    {
        (new Book)->get();

        return View::make('products/index')->render();
    }

    public function create()
    {
        return View::make('products/create')->render();
    }

    public function store()
    {
        (new Book)->create("asdas", "dasdsad", 13, 132);
        return "Product Created";
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
                    $new_book = new Book;
                    $errors = $new_book->validate($_POST);
                    if (empty($errors) && $new_book->create($_POST['sku'], $_POST['name'], $_POST['price'], $_POST['weight'])) {
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
                    $new_furniture = new Furniture;
                    $errors = $new_furniture->validate($_POST);
                    if (empty($errors) && $new_furniture->create($_POST['sku'], $_POST['name'], $_POST['price'], $_POST['height'], $_POST['width'], $_POST['length'])) {
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
}
