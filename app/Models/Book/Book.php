<?php

declare(strict_types=1);

namespace App\Models\Book;

use App\App;
use App\Models\Product\Product;
use App\Validators\Validator;

class Book extends Product
{
    public static function get(): array
    {
        $productsStat = App::db()->prepare("SELECT * FROM books JOIN products ON books.product_id = products.id");

        $productsStat->execute();

        return $productsStat->fetchAll();
    }

    public function create(string $sku, string $name, float $price, float $weight): bool
    {
        $db = App::db();

        $db->beginTransaction();

        try {
            $productStat = $db->prepare("INSERT INTO products (sku,name,price) VALUES (:sku,:name,:price)");

            $productStat->execute([
                ":sku" => $sku,
                ":name" => $name,
                ":price" => $price
            ]);

            $productId = (int) $db->lastInsertId();

            $bookStat = $db->prepare("INSERT INTO books (product_id,weight) VALUES (:product_id,:weight)");

            $bookStat->execute([
                ":product_id" => $productId,
                ":weight" => $weight
            ]);

            $db->commit();

            return true;
        } catch (\Throwable $th) {
            $db->rollback();
            return false;
        }
    }

    public static function validate(array $request): array
    {
        parent::validate($request);

        // Validate Weight
        // 1- Available
        if (!empty($request['weight'])) {
            // 2- Int Weight
            if (!Validator::numeric($request['weight'])) {
                parent::$errors['weight'][] = 'The weight must be an integer';
            }

            // 2- Max Weight
            if (!Validator::max($request['weight'], 999.99)) {
                parent::$errors['weight'][] = 'The weight must be less than 999.99 KG';
            }

            // 3- Min Weight
            if (!Validator::min($request['weight'], 0)) {
                parent::$errors['weight'][] = 'The weight must be greater than 0 KG';
            }
        } else {
            parent::$errors['weight'][] = 'Please enter the weight for this product';
        }

        return parent::$errors;
    }
}
