<?php

namespace App\Http\Controllers\Front\Common;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Inquire;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MiscController extends Controller
{
    public function changeCurrency(Request $request) {
        try {
            setCurrency($request->code);
        } catch (\Exception $e) {
            $output['status'] = 0;
        }
        $output['status'] = 1;
        echo json_encode($output);
        return;
    }

    public function changeCity(Request $request) {
        try {
            setCity($request->city_id);
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

    public function inquireRequest(Request $request) {
        $data = $this->validate($request, [
            'company_name' => REQUIRED_STRING_VALIDATION,
            'name' => REQUIRED_STRING_VALIDATION,
            'email' => REQUIRED_EMAIL_VALIDATION,
            'phone' => REQUIRED_STRING_VALIDATION,
            'message' => NULLABLE_TEXT_VALIDATION,
            'file' => NULLABLE_FILE_VALIDATION
        ]);

        try {
            $contact = Inquire::create($data);
            if(isset($request->file)) {
                $contact->addMedia($request->file)->toMediaCollection(INQUIRE_PATH);
            }
            if($contact) {
                $message = 'You request submitted successfully.';
//                Email::sendEmailForms($contact, $message);
            }
        } catch (\Exception $e) {
            return response([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function introduce($type) {

        $translation = [
            'company' => [
                'ar' => 'شركه',
                'en' => 'Company'
            ],
            'individual' => [
                'ar' => 'فرد',
                'en' => 'Individual'
            ]
        ];

        if($type == 'individual' || $type == 'company') {
            Session::put('userType', $type);
            Session::put('userTypeTranslation', $translation[$type]);
        }

        return redirect()->back();
    }
}
