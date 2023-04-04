<?php

declare(strict_types=1);

namespace App\Models\DVD;

use App\App;
use App\Validators\Validator;
use App\Models\Product\Product;

class DVD extends Product
{
    public function __construct(int $id = null, string $sku, string $name, int|float $price, private int $size)
    {
        parent::__construct($id, $sku, $name, $price);
    }

    public function getDetailsName()
    {
        return "Size";   
    }

    public function getDetails()
    {
        return $this->size. " MB";   
    }


    public static function get(): array
    {
        $productsStat = App::db()->prepare("SELECT * FROM dvds JOIN products ON dvds.product_id = products.id");

        $productsStat->execute();

        $allDvds = array_map(function ($dvd) {
            $dvd = new DVD($dvd['id'], $dvd['sku'], $dvd['name'], (float)$dvd['price'], (int) $dvd['size']);

            return $dvd;
        }, $productsStat->fetchAll());

        return $allDvds;
    }

    public static function create(string $sku, string $name, float $price, float $size): bool
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

            $dvdStat = $db->prepare("INSERT INTO dvds (product_id,size) VALUES (:product_id,:size)");

            $dvdStat->execute([
                ":product_id" => $productId,
                ":size" => $size
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

        // Validate Size
        // 1- Available
        if (!empty($request['size'])) {
            // 2- Int Size
            if (!Validator::numeric($request['size'])) {
                parent::$errors['size'][] = 'The size must be an integer';
            }
            // 3- Max Size
            if (!Validator::max($request['size'], 4294967295)) {
                parent::$errors['size'][] = 'The size must be less than 4294967295 MB';
            }

            // 4- Min Size
            if (!Validator::min($request['size'], 0)) {
                parent::$errors['size'][] = 'The size must be greater than 0 MB';
            }
        } else {
            parent::$errors['size'][] = 'Please enter the size for this product';
        }

        return parent::$errors;
    }
}
