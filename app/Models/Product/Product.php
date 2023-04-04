<?php

declare(strict_types=1);

namespace App\Models\Product;

use App\App;
use App\Models\DVD\DVD;
use App\Models\Book\Book;
use App\Validators\Validator;
use App\Models\Furniture\Furniture;

abstract class Product
{
    protected static array $errors = [];

    public function __construct(protected ?int $id = null, protected string $sku, protected string $name, protected int|float $price)
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    abstract public function getDetailsName();
    abstract public function getDetails();

    public static function all(): array
    {
        // Get All Products separately 
        $allBooks = Book::get();
        $allDvds = DVD::get();
        $allFurniture = Furniture::get();
        
        // Merge Different Products Types
        $allProducts = array_merge($allBooks, $allDvds, $allFurniture);
        
        // Sort According to the ID
        usort($allProducts, function ($a, $b) {
            if ($a->id == $b->id) return 0;
            return ($a->id < $b->id) ? -1 : 1;
        });

        return $allProducts;
    }

    public static function massDelete (array $products_id) {
        $db = App::db();

        // String of Question Marques equivalent to no. of IDs 
        $qMarques = implode(',', array_fill(0, count($products_id), '?'));

        $deleteStat = $db->prepare("DELETE FROM products WHERE id IN ($qMarques)");

        return $deleteStat->execute($products_id);
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
