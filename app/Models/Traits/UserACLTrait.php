<?php

namespace App\Models\Traits;

trait UserACLTrait
{
    public function permissions()
    {
        $tenant = $this->tenant()->first();
        $plan = $tenant->plan;
        $profiles = $plan->profiles;

        $permissions = [];

        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                $permissions[] = $permission->name;
            }
        }

        return $permissions;
    }

    public function hasPermissions(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin()
    {
        return in_array($this->email, config('acl.admins'));
    }

    public function isTenant()
    {
        return !in_array($this->email, config('acl.admins'));
    }
}
