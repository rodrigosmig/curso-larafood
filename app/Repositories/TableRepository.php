<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\TableRepositoryInterface;

class TableRepository implements TableRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'tables';    
    }

    public function getTablesByTenantUuid(string $uuid)
    {
        return DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
                ->where('tenants.uuid', $uuid)
                ->select('categories.*')
                ->get();
    }

    public function getTablesByTenantId(int $id)
    {
        return DB::table($this->table)->where('tenant_id', $id)->get();
    }

    public function getTableByUuid(string $uudi)
    {
        return DB::table($this->table)->where('uuid', $uudi)->first();
    }
}