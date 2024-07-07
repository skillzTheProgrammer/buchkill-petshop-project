<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;

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

    public function show($uuid)
    {
        try {
            $product = $this->productService->getSingleProduct($uuid);
            return ResponseHelper::success($product, 'Product retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage());
        }
    }

    //this is supposed to be an admin feature i think but for the purpose of this project users can update product
    public function update(UpdateProductRequest $request, $uuid)
    {
        try {
            $product = $this->productService->update($uuid, $request->validated());
            return ResponseHelper::success($product, 'Product updated successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage());
        }
    }

    //this is supposed to be an admin feature i think but for the purpose of this project users can delete product
    public function destroy($uuid)
    {
        try {
            $this->productService->delete($uuid);
            return ResponseHelper::success(null, 'Product deleted successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error($e->getMessage());
        }
    }
}
