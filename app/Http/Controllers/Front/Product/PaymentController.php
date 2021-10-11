<?php

namespace App\Http\Controllers\Front\Product;

use App\Http\Controllers\Controller;
use Devinweb\Payment\Facades\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public string $provider = 'payfort';

    public function form() {
        return view('front.payment.form');
    }

    public function submit() {
        $merchant_reference = rand(0, getrandmax());
        return Payment::use('payfort', $merchant_reference)->pay();
    }

    public function success() {
        return view('payfort.success');
    }

    public function error() {
        return view('payfort.error');
    }
}
