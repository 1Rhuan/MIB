<?php

namespace App\Http\Controllers;

use App\Http\Requests\PixPaymentRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use App\Payments\Contracts\PaymentGateway;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    private PaymentGateway $paymentGateway;
    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function store(PixPaymentRequest $request)
    {
        $paymentData = [
            'reference'   => (string) Str::ulid(),
            'description' => "TEST PAYMENT",
            'item_name'  => "TEST PAYMENT",
            'email'      => "TESTEMAIL@gmail.com",
            'amount'     => 12.9,
        ];

        $response = $this->paymentGateway->createPix($paymentData);

        return [
            "description" => $response->description,
            "amount" => $response->totalPaidAmount,
            "qr_code" => $response->qrCode,
            "qr_code_base64" => $response->qrCodeBase64,
            "qr_code_url" => $response->ticketUrl,
        ];
    }

    public function getPayment($id)
    {
         $response =  $this->paymentGateway->getPayment($id);
         return $response->toArray();
    }
}
