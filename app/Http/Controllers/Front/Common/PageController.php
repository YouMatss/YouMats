<?php

namespace App\Http\Controllers\Front\Common;

use App\Http\Controllers\Controller;
use App\Models\FAQ;

class PageController extends Controller
{
    public function faqs() {
        $faqs = FAQ::orderBy('sort')->get();
        return view('front.pages.faq')->with(compact('faqs'));
    }

    public function aboutUs() {
        return view('front.pages.about');
    }
}
