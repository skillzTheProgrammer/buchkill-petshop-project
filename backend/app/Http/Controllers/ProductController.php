<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function allProducts()
    {
        try {
            $products = $this->productService->getAll();
            return ResponseHelper::success($products, 'Products retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage());
        }
    }

 //this is supposed to be an admin feature i think but for the purpose of this project users can create product
    public function store(ProductRequest $request)
    {
        try {
            $product = $this->productService->create($request->validated());
            return ResponseHelper::success($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage());
        }
    }
}
