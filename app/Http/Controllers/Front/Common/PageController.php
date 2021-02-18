<?php

namespace App\Http\Controllers\Front\Common;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\FAQ;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function faqs() {
        $faqs = FAQ::orderBy('sort')->get();
        return view('front.pages.faq')->with(compact('faqs'));
    }

    public function aboutUs() {
        return view('front.pages.about');
    }

    public function contactUs() {
        return view('front.pages.contact');
    }

    public function contactUsRequest(Request $request) {
        $data = $this->validate($request, [
            'name' => REQUIRED_STRING_VALIDATION,
            'email' => REQUIRED_EMAIL_VALIDATION,
            'phone' => REQUIRED_STRING_VALIDATION,
            'message' => NULLABLE_TEXT_VALIDATION
        ]);

        try {
            $contact = Contact::create($data);
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
}
