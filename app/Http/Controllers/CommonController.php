<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommonController extends Controller
{
    public function changeCurrency(Request $request) {
        try {
            Session::put('currencyCode', $request->code);
            setCurrency();
        } catch (\Exception $e) {
            $output['status'] = 0;
        }
        $output['status'] = 1;
        echo json_encode($output);
        return;
    }

    public function faqs() {
        $faqs = FAQ::orderBy('sort')->get();
        return view('front.faq')->with(compact('faqs'));
    }

    public function aboutUs() {
        return view('front.about');
    }
}
