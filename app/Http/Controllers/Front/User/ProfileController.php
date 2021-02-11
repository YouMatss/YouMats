<?php

namespace App\Http\Controllers\Front\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index() {
        $user = auth()->user();
        $orders = $user->orders;

        return view('front.user.profile')->with(compact('user', 'orders'));
    }

    public function updateProfile(UserProfileRequest $request) {
        $data = $request->validated();

        $auth_user = User::find(auth()->user()->id);
        abort_if(!$auth_user, 401);

        if(isset($data['profile'])) {
            $auth_user->clearMediaCollection(USER_PROFILE);
            $auth_user->addMedia($data['profile'])->toMediaCollection(USER_PROFILE);
        }
        if(isset($data['cover'])) {
            $auth_user->clearMediaCollection(USER_COVER);
            $auth_user->addMedia($data['cover'])->toMediaCollection(USER_COVER);
        }
        if(isset($data['licenses']))
            foreach ($data['licenses'] as $license)
                $auth_user->addMedia($license)->toMediaCollection(COMPANY_PATH);

        if($data['email'] != $auth_user->email)
            $data['email_verified_at'] = null;
        else
            $data['email_verified_at'] = $auth_user->email_verified_at;

        $auth_user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'email_verified_at' => $data['email_verified_at'],
            'phone' => $data['phone'],
            'phone2' => $data['phone2'],
            'address' => $data['address'],
            'address2' => $data['address2'],
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back();
    }
}
