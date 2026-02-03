<?php

namespace App\Http\Controllers;

use App\DTOs\CreateOrderDto;
use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $OrderService
    )
    {}

    public function create(CreateOrderRequest $request)
    {
        $data = $request->validated();

        return $this->OrderService->createOrder(
            CreateOrderDto::fromArray($data)
        );
    }
}
