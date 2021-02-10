<?php

namespace App\Http\Controllers\Front\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Providers\RouteServiceProvider;
use App\Models\Vendor;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::VENDOR_HOME;

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:vendor');
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'city_id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'unique:vendors'],
            'phone' => ['nullable', 'string', 'max:30'],
            'phone2' => ['nullable', 'string', 'max:30'],
            'whatsapp_phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:191'],
            'address2' => ['nullable', 'string', 'max:191'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        return Vendor::create([
            'membership_id' => env('MEMBERSHIP_ID', 1),
            'city_id' => $data['city_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'phone2' => $data['phone2'],
            'whatsapp_phone' => $data['whatsapp_phone'],
            'address' => $data['address'],
            'address2' => $data['address2'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    protected function showRegistrationForm()
    {
        $cities = City::all();
        return view('front.vendor.auth.register', ['cities' => $cities]);
    }

    /**
     * @return Guard|StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('vendor');
    }
}
