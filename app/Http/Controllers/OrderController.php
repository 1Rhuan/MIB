<?php

namespace App\Http\Controllers;

use App\Services\CreateOrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private readonly CreateOrderService $createOrderService
    )
    {}

    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'email'      => ['required', 'email'],
            'name'       => ['required', 'string'],
            'nickname'   => ['required', 'string'],
            'steam_id'   => ['nullable', 'string'],
            'quantity'   => ['required', 'integer', 'min:1'],
        ]);

        return $this->createOrderService->createOrder($data);
    }
}
