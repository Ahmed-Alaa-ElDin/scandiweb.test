<?php

declare(strict_types=1);

namespace App\Models\Book;

use App\App;
use App\Validators\Validator;
use App\Models\Product\Product;

class Book extends Product
{
    private int|float $weight;

    public function __construct(int $id = null, string $sku, string $name, int|float $price, private array $arguments)
    {
        parent::__construct($id, $sku, $name, $price);

        $this->weight = (float) $arguments['weight'];
    }

    public function getDetailsName(): string
    {
        return "Weight";
    }

    public function getDetails(): string
    {
        return $this->weight . " KG";
    }

    public static function get(): array
    {
        $productsStat = App::db()->prepare("SELECT * FROM books JOIN products ON books.product_id = products.id");

        $productsStat->execute();

        $allBooks = array_map(function ($book) {
            $book = new Book($book['id'], $book['sku'], $book['name'], (float)$book['price'], ["weight" => (float) $book['weight']]);

            return $book;
        }, $productsStat->fetchAll());

        return $allBooks;
    }

    public static function validate(array $request): array
    {
        parent::validate($request);

        // Validate Weight
        // 1- Available
        if (!empty($request['arguments']['weight'])) {
            // 2- Int Weight
            if (!Validator::numeric($request['arguments']['weight'])) {
                parent::$errors['weight'][] = 'The weight must be an integer';
            }

            // 2- Max Weight
            if (!Validator::max($request['arguments']['weight'], 999.99)) {
                parent::$errors['weight'][] = 'The weight must be less than 999.99 KG';
            }

            // 3- Min Weight
            if (!Validator::min($request['arguments']['weight'], 0)) {
                parent::$errors['weight'][] = 'The weight must be greater than 0 KG';
            }
        } else {
            parent::$errors['weight'][] = 'Please enter the weight for this product';
        }

        return parent::$errors;
    }


    public function create(): bool
    {
        $db = App::db();

        $db->beginTransaction();

        try {
            $productStat = $db->prepare("INSERT INTO products (sku,name,price) VALUES (:sku,:name,:price)");

            $productStat->execute([
                ":sku" => $this->sku,
                ":name" => $this->name,
                ":price" => $this->price
            ]);

            $productId = (int) $db->lastInsertId();

            $bookStat = $db->prepare("INSERT INTO books (product_id,weight) VALUES (:product_id,:weight)");

            $bookStat->execute([
                ":product_id" => $productId,
                ":weight" => $this->weight
            ]);

            $db->commit();

            return true;
        } catch (\Throwable $th) {
            $db->rollback();

            return false;
        }
    }
}
