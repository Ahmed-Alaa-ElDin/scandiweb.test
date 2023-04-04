<?php

declare(strict_types=1);

namespace App\Models\Product;

use App\App;
use App\DB\DB;
use App\Validators\Validator;

abstract class Product
{
    protected static array $errors = [];
    
    public function __construct() {
    }
    
    public static function validate(array $request)
    {
        // Validate SKU
        // 1- Available
        if (!empty($request['sku'])) {
            // 2-  Unique SKU
            if (!Validator::unique($request['sku'], 'sku', 'products')) {
                self::$errors["sku"][] = 'Please enter a unique SKU for this product';
            };
            // 3-  Max SKU
            if (!Validator::max($request['sku'], 24)) {
                self::$errors["sku"][] = 'The maximum number of character is 24';
            };
        } else {
            self::$errors["sku"][] = 'Please enter the SKU for this product';
        }

        // Validate name
        // 1- Available
        if (!empty($request['name'])) {
            // 2-  Max Name
            if (!Validator::max($request['name'], 255)) {
                self::$errors['name'][] = 'The maximum number of character is 255';
            }
        } else {
            self::$errors['name'][] = 'Please enter the name for this product';
        }

        // Validate price
        // 1- Available
        if (!empty($request['price'])) {
            // 2- Numeric Price
            if (!Validator::numeric($request['price'])) {
                self::$errors['price'][] = 'The price must be a number';
            }
            // 3- Max Price
            if (!Validator::max($request['price'], 99999999.99)) {
                self::$errors['price'][] = 'The maximum value of price is $99999999.99';
            }

            // 4- Min Price
            if (!Validator::min($request['price'], 0)) {
                self::$errors['price'][] = 'The minimum value of price is $0';
            }
        } else {
            self::$errors['price'][] = 'Please enter the price for this product';
        }

    }
}
