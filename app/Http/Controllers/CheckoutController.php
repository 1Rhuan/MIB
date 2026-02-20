<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChekoutRequest;
use App\Models\Product;
use App\Services\CheckoutService;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        public CheckoutService $checkoutService,
    ) {}

    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('checkout.index', compact('product'));
    }

    public function process(ChekoutRequest $request)
    {
        $data = $request->validated();
        $product = Product::where('slug', $data['product_slug'])->firstOrFail();
        $response = $this->checkoutService->process($product, $data);

        return redirect()->route('order.payment', ['reference' => $response]);
    }
}
