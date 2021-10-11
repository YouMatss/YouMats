<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use Devinweb\Payment\Facades\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public string $provider = 'payfort';

    public function submit() {
        $merchant_reference = Payment::use($this->provider)->generateMerchantReference();
        return Payment::use($this->provider, $merchant_reference)->pay();
    }

    public function success() {
        return view('payfort.success');
    }

    public function error() {
        return view('payfort.error');
    }
}
