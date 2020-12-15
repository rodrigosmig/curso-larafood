<?php

namespace App\Repositories\Contracts;

interface TenantRepositoryInterface
{
    public function getallTenants(int $per_page);
    public function getTenantByUuid(String $uuid);
}