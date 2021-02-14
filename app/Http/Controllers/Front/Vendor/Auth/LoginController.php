<?php

namespace App\Http\Controllers\Front\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo = RouteServiceProvider::HOME;

    public function __construct() {
        parent::__construct();
        $this->middleware('guest:vendor')->except('logout');
    }

    protected function showLoginForm()
    {
        return view('front.vendor.auth.login');
    }

    protected function guard()
    {
        return Auth::guard('vendor');
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    protected function loggedOut(Request $request)
    {
        return $request->wantsJson()
            ? new Response('', 204)
            : redirect($this->redirectTo);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request): array
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1
        ];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = Vendor::where($this->username(), $request->{$this->username()})->first();

        if($user && !$user->active && Hash::check($request->password, $user->password))
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.inactive')]
            ]);    

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
            'active' => $inactiveMsg ?? ''
        ]);
    }
}
