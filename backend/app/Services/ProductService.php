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

    public function update($uuid, array $data)
    {
        $product = $this->getSingleProduct($uuid);
        $product->update($data);
        return $product;
    }

     public function delete($uuid)
    {
        $product = $this->getSingleProduct($uuid);
        $product->delete();
    }

}
