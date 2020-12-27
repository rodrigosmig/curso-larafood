<?php

namespace App\Tenant;

use App\Models\Tenant;

class ManagerTenant
{
    public function getTenantId()
    {
        return auth()->check() ? auth()->user()->tenant_id : '';
    }

    public function getTenant(): Tenant
    {
        return auth()->check() ? auth()->user()->tenant_id : '';
    }

    public function isAdmin(): bool
    {
        return is_array(auth()->user->email, config('tenant.admins'));
    }
}
