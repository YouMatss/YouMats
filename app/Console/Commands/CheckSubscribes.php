<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Subscribe;
use App\Notifications\VendorSubscribed;
use App\Notifications\VendorSubscribeRenew;
use Carbon\Carbon;
use Devinweb\Payment\Facades\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CheckSubscribes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribe:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recurring monthly payment';

    public string $provider = 'payfort';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscribes = Subscribe::whereDate('expiry_date', today('+3'))->get();

        foreach ($subscribes as $subscribe) {
            if(isset($subscribe->vendor)) {

                $merchant_reference = Payment::use($this->provider)->generateMerchantReference();

                $arrData = [
                    'command' => 'PURCHASE',
                    'access_code' => env('PAYFORT_ACCESS_CODE'),
                    'merchant_identifier' => env('PAYFORT_MERCHANT_IDENTIFIER'),
                    'merchant_reference' => $merchant_reference,
                    'amount' => $subscribe->price,
                    'currency' => env('PAYFORT_CURRENCY', 'SAR'),
                    'language' => env('PAYFORT_LANGUAGE', 'en'),
                    'customer_email' => $subscribe->vendor->email,
                    'eci' => 'RECURRING',
                    'token_name' => $subscribe->vendor->token_name
                ];

                $signature = Payment::use($this->provider)->calculateSignature($arrData, 'request');
                $arrData['signature'] = $signature;

                $response = Http::post('https://sbpaymentservices.payfort.com/FortAPI/paymentApi', $arrData);

                $response_code = $response->object()->response_code;

                if(substr($response_code, 2) == '000') {
                    $subscribe->update([
                        'expiry_date' => Carbon::yesterday()
                    ]);

                    $newSubscribe = Subscribe::create([
                        'vendor_id' => $subscribe->vendor_id,
                        'membership_id' => $subscribe->membership_id,
                        'category_id' => $subscribe->category_id,
                        'expiry_date' => Carbon::now()->addMonth(),
                        'price' => $subscribe->price
                    ]);

                    foreach(Admin::all() as $admin) {
                        $admin->notify(new VendorSubscribeRenew($newSubscribe));
                    }
                }
            }
        }
    }
}
