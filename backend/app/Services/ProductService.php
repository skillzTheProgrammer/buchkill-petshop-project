<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getAll()
    {
        return Product::all();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function getSingleProduct($uuid)
    {
        return Product::where('uuid', $uuid)->firstOrFail();
    }

}
