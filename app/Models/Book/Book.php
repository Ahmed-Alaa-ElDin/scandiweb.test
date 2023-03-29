<?php

declare(strict_types=1);

namespace App\Models\Book;

use App\Models\Product\Product;

class Book extends Product
{
    public function __construct(string $sku, string $name, float $price, private float $weight)
    {
        parent::__construct($sku, $name, $price);
    }
}
