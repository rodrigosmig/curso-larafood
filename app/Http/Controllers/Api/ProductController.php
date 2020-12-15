<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Api\TenantFormRequest;

class ProductController extends Controller
{
    protected $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function productsByTenant(TenantFormRequest $request)
    {
        $products = $this->productService->getProductsByTenantUuid($request->company_token, $request->get('categories', []));
        
        return ProductResource::collection($products);
    }

    public function show(TenantFormRequest $request, $flag)
    {
        $product = $this->productService->getProductByFlag($flag);

        if (! $product) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }
        
        return new ProductResource($product);
    }
}
