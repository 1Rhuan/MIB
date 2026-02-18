<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    public function show(string $reference)
    {
        $order = Order::where('reference', $reference)->first();

        if (! $order) {
            return redirect()->route('home');
        }

        $payment = $order->payment->first();
        $product = $order->product;

        if ($order->status === OrderStatus::PAID) {
            return view('payment.success', compact('order', 'product'));
        }

        $expiration = $payment->date_expiration;
        $now = Carbon::now();

        if ($order->status === OrderStatus::PENDING && $now->greaterThan($expiration)) {

            $order->update([
                'status' => OrderStatus::CANCELLED,
            ]);

            return view('payment.expired', compact('order', 'product'));
        }

        if ($order->status === OrderStatus::CANCELLED) {
            return view('payment.expired', compact('order', 'product'));
        }

        $expireIn = $now->diffInSeconds($expiration, false);

        return view('payment.index', [
            'payment' => [
                'qr_code_image' => $payment->qr_code_base64,
                'qr_code' => $payment->qr_code,
                'expiresIn' => $expireIn,
            ],
            'order' => $order,
            'product' => $product,
        ]);
    }
}
