<?php

namespace App\Payments\Contracts;

interface PaymentGateway
{
    public function createPix(array $data);
    public function getStatus(array $data);
}
