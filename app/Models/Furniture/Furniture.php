<?php

declare(strict_types=1);

namespace App\Models\Furniture;

use App\App;
use App\Models\Product\Product;
use App\Validators\Validator;

class Furniture extends Product
{
    private int $height;
    private int $width;
    private int $length;

    public function create(string $sku, string $name, float $price, int $height, int $width, int $length): bool
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

            $furnitureStat = $db->prepare("INSERT INTO furniture (product_id,height,width,length) VALUES (:product_id,:height,:width,:length)");

            $furnitureStat->execute([
                ":product_id" => $productId,
                "height" => $height,
                "width" => $width,
                "length" => $length
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

        // Validate Height
        // 1- Available
        if (!empty($request['height'])) {
            // 2- Int Size
            if (!Validator::numeric($request['height'])) {
                parent::$errors['height'][] = 'The height must be an integer';
            }
            // 3- Max Size
            if (!Validator::max($request['height'], 4294967295)) {
                parent::$errors['height'][] = 'The height must be less than 4294967295 CM';
            }

            // 4- Min Size
            if (!Validator::min($request['height'], 0)) {
                parent::$errors['height'][] = 'The height must be greater than 0 CM';
            }
        } else {
            parent::$errors['height'][] = 'Please enter the height for this product';
        }

        // Validate Width
        // 1- Available
        if (!empty($request['width'])) {
            // 2- Int Size
            if (!Validator::numeric($request['width'])) {
                parent::$errors['width'][] = 'The width must be an integer';
            }
            // 3- Max Size
            if (!Validator::max($request['width'], 4294967295)) {
                parent::$errors['width'][] = 'The width must be less than 4294967295 CM';
            }

            // 4- Min Size
            if (!Validator::min($request['width'], 0)) {
                parent::$errors['width'][] = 'The width must be greater than 0 CM';
            }
        } else {
            parent::$errors['width'][] = 'Please enter the width for this product';
        }

        // Validate Length
        // 1- Available
        if (!empty($request['length'])) {
            // 2- Int Size
            if (!Validator::numeric($request['length'])) {
                parent::$errors['length'][] = 'The length must be an integer';
            }
            // 3- Max Size
            if (!Validator::max($request['length'], 4294967295)) {
                parent::$errors['length'][] = 'The length must be less than 4294967295 CM';
            }

            // 4- Min Size
            if (!Validator::min($request['length'], 0)) {
                parent::$errors['length'][] = 'The length must be greater than 0 CM';
            }
        } else {
            parent::$errors['length'][] = 'Please enter the length for this product';
        }

        return parent::$errors;
    }
}
