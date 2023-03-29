<?php 

namespace App\Controllers;

use Exception;

class ProductController 
{
    public function index()
    {
        return "All Products";
    }

    public function create()
    {
        return "Create Product";
    }

    public function store()
    {
        return "Product Created";
    }
}

