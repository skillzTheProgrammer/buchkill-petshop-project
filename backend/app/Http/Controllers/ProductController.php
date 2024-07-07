<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Helpers\ResponseHelper;

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
}
