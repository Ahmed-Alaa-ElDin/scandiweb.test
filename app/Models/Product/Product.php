<?php

declare(strict_types=1);

namespace App\Models\Product;

abstract class Product
{
    public function __construct(
        protected string $sku,
        protected string $name,
        protected float $price,
    ) {
    }
}
