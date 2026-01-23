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
        $data = $request->validated();

        $item = Item::findOrFail($data['item_id']);

        $user = user::updateOrCreate([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'steam_id' => $data['steam_id'],
            'nickname' => $data['nickname'],
        ]);

        $order = Order::create([
            'reference' => Str::ulid(),
            'user_id' => $user->id,
            'item_id' => $data['item_id'],
            'amount' => $item->price,
        ]);

        $paymentData = [
            'reference'   => (string) $order->reference,
            'description' => $item->description,
            'item_name'  => $item->name,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'email'      => $user->email,
            'amount'     => (float) $order->amount,
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
