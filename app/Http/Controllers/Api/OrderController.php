<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Http\Requests\Api\TenantFormRequest;

class OrderController extends Controller
{
    protected $orderService;
    
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->createNewOrder($request->all());

        return new OrderResource($order);
    }

    public function show($identify)
    {
        $order = $this->orderService->getOrderByIdentify($identify);

        if (! $order) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return new OrderResource($order);
    }

    public function myOrders()
    {
        $orders = $this->orderService->getOrdersByClient();

        return OrderResource::collection($orders);
    }
}
