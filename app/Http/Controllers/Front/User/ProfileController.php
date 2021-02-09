<?php

namespace App\Http\Controllers\Front\User;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index() {
        return view('front.user.profile');
    }
}
