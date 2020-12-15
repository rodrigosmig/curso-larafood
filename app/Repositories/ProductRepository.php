<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'products';    
    }

    public function getTablesByTenantUuid(string $uuid, array $categories)
    {
        return DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
                ->where('tenants.uuid', $uuid)
                ->select('categories.*')
                ->get();
    }

    public function getProductsByTenantId(int $id, array $categories)
    {
        return DB::table($this->table)
            ->join('category_product', 'category_product.product_id', '=', 'products.id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('products.tenant_id', $id)
            ->where('categories.tenant_id', $id)
            ->where(function ($query) use ($categories) {
                if (! empty($categories)) {
                    $query->whereIn('categories.url', $categories);
                }
            })
            ->get();
    }

    public function getProductByFlag(string $flag)
    {
        return DB::table($this->table)
            ->where('flag', $flag)
            ->first();
    }
}