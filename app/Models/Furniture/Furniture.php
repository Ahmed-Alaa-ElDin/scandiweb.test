<?php

declare(strict_types=1);

namespace App\Models\Furniture;

use App\App;
use App\Validators\Validator;
use App\Models\Product\Product;

class Furniture extends Product
{
    private int|float $height;
    private int|float $width;
    private int|float $length;

    public function __construct(int $id = null, string $sku, string $name, int|float $price, private array $arguments)
    {
        parent::__construct($id, $sku, $name, $price);

        $this->height = (float) $arguments['height'];
        $this->width = (float) $arguments['width'];
        $this->length = (float) $arguments['length'];
    }

    public function getDetailsName()
    {
        return "Dimensions";
    }

    public function getDetails()
    {
        return "{$this->height} x {$this->width} x {$this->length}";
    }


    public static function get(): array
    {
        $productsStat = App::db()->prepare("SELECT * FROM furniture JOIN products ON furniture.product_id = products.id");

        $productsStat->execute();

        $allFurniture = array_map(function ($furniture) {
            $furniture = new Furniture($furniture['id'], $furniture['sku'], $furniture['name'], (float)$furniture['price'], ["height" => (int) $furniture['height'], "width" => (int) $furniture['width'], "length" => (int) $furniture['length']]);

            return $furniture;
        }, $productsStat->fetchAll());

        return $allFurniture;
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

            $furnitureStat = $db->prepare("INSERT INTO furniture (product_id,height,width,length) VALUES (:product_id,:height,:width,:length)");

            $furnitureStat->execute([
                ":product_id" => $productId,
                "height" => $this->height,
                "width" => $this->width,
                "length" => $this->length
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
        if (!empty($request['arguments']['height'])) {
            // 2- Int Size
            if (!Validator::numeric($request['arguments']['height'])) {
                parent::$errors['height'][] = 'The height must be an integer';
            }
            // 3- Max Size
            if (!Validator::max($request['arguments']['height'], 4294967295)) {
                parent::$errors['height'][] = 'The height must be less than 4294967295 CM';
            }

            // 4- Min Size
            if (!Validator::min($request['arguments']['height'], 0)) {
                parent::$errors['height'][] = 'The height must be greater than 0 CM';
            }
        } else {
            parent::$errors['height'][] = 'Please enter the height for this product';
        }

        // Validate Width
        // 1- Available
        if (!empty($request['arguments']['width'])) {
            // 2- Int Size
            if (!Validator::numeric($request['arguments']['width'])) {
                parent::$errors['width'][] = 'The width must be an integer';
            }
            // 3- Max Size
            if (!Validator::max($request['arguments']['width'], 4294967295)) {
                parent::$errors['width'][] = 'The width must be less than 4294967295 CM';
            }

            // 4- Min Size
            if (!Validator::min($request['arguments']['width'], 0)) {
                parent::$errors['width'][] = 'The width must be greater than 0 CM';
            }
        } else {
            parent::$errors['width'][] = 'Please enter the width for this product';
        }

        // Validate Length
        // 1- Available
        if (!empty($request['arguments']['length'])) {
            // 2- Int Size
            if (!Validator::numeric($request['arguments']['length'])) {
                parent::$errors['length'][] = 'The length must be an integer';
            }
            // 3- Max Size
            if (!Validator::max($request['arguments']['length'], 4294967295)) {
                parent::$errors['length'][] = 'The length must be less than 4294967295 CM';
            }

            // 4- Min Size
            if (!Validator::min($request['arguments']['length'], 0)) {
                parent::$errors['length'][] = 'The length must be greater than 0 CM';
            }
        } else {
            parent::$errors['length'][] = 'Please enter the length for this product';
        }

        return parent::$errors;
    }
}
