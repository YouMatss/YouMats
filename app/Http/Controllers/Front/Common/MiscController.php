<?php

namespace App\Http\Controllers\Front\Common;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
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

    public function subscribeRequest(Request $request) {
        $data = $this->validate($request, [
            'email' => 'email|unique:subscribers,email'
        ], [
            'email.unique' => 'You already subscribed.'
        ]);

        try {
            $subscriber = Subscriber::create($data);
            if($subscriber) {
                $message = 'You subscribe successfully.';
//                Email::sendEmailForms($contact, $message);
            }
        } catch (\Exception $e) {
            return response([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
        return response([
            'status' => true,
            'message' => $message
        ]);
    }
}
