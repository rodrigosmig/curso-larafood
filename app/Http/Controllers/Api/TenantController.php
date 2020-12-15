<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\TenantService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;

class TenantController extends Controller
{
    protected $tenantService;
    
    public function __construct(TenantService $service)
    {
        $this->tenantService = $service;
    }

    public function index(Request $request)
    {
        $per_page = (int) $request->get('per_page', 15);

        $tenants = $this->tenantService->getAllTenants($per_page);

        return TenantResource::collection($tenants);
    }

    public function show($uuid)
    {
        $tenant = $this->tenantService->getTenantByUuid($uuid);

        if (!$tenant) {
            return response()->json(['mesage' => 'Not Found'], 404);
        }
        
        return new TenantResource($tenant);
    }
}
