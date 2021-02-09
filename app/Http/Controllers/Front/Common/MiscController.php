<?php

namespace App\Http\Controllers\Front\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MiscController extends Controller
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
}
