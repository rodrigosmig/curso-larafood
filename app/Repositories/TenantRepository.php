<?php

namespace App\Repositories;

use App\Models\Tenant;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TenantRepository implements TenantRepositoryInterface
{
    public function __construct(Tenant $tenant)
    {
        $this->entity = $tenant;
    }
    
    public function getallTenants(int $per_page)
    {
        return $this->entity->paginate($per_page);
    }

    public function getTenantByUuid(String $uuid)
    {
        return $this->entity->where('uuid', $uuid)->first();
    }
}