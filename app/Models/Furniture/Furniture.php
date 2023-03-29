<?php

declare(strict_types=1);

namespace App\Models\Furniture;

use App\Models\Product\Product;

class Furniture extends Product
{
    private int $height;
    private int $width;
    private int $length;
}
