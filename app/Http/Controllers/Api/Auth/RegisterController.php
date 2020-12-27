<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Services\ClientService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Requests\Api\StoreClientRequest;

class RegisterController extends Controller
{
    protected $clientService;
    
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
    public function store(StoreClientRequest $request)
    {
        $client = $this->clientService->createNewClient($request->all());

        return new ClientResource($client);
    }
}
