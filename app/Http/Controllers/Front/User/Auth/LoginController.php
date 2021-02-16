<?php

namespace App\Http\Controllers\Front\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    public function __construct() {
        Parent::__construct();
        $this->middleware('guest')->except('logout');
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

    /**
     * @param Request $request
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request) {
        $user = User::where($this->username(), $request->{$this->username()})->first();

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
