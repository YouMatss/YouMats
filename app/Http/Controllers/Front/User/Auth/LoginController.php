<?php

namespace App\Http\Controllers\Front\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
}
