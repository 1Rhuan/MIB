<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function status(string $reference)
    {
        $order = Order::where('reference', $reference)->firstOrFail();

        if (! $order) {
            return response()->noContent(404);
        }

        return response()->json([
            'status' => $order->status,
        ]);
    }
}
