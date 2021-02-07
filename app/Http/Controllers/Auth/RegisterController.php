<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @return Application|Factory|View
     */
    public function showVendorRegisterForm()
    {
        $cities = City::all();
        return view('auth.register', ['authType' => 'vendor', 'cities' => $cities]);
    }

    /**
     * @return Application|Factory|View
     */
    public function showRegistrationForm()
    {
        return view('auth.register', ['authType' => 'user']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function registerVendor(Request $request): RedirectResponse
    {
        $data = $this->vendorValidator($request);

        event(new Registered($vendor = $this->createVendor($data)));

        $this->guard('admin')->login($vendor);

        return redirect()->route('vendor.index');
    }

    protected function guard($guard = 'web')
    {
        return Auth::guard($guard);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function vendorValidator(Request $request): array
    {
        return $request->validate([
            'city_id' => 'required|numeric',
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:vendors',
            'phone' => 'nullable|string|max:30',
            'phone2' => 'nullable|string|max:30',
            'whatsapp_phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:191',
            'address2' => 'nullable|string|max:191',
            'password' => 'required|string|min:8|confirmed'
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function createVendor(array $data)
    {
        //Workaround to assign a static membership
        $data['membership_id'] = env('MEMBERSHIP_ID') ?? 1;

        //Hash the password
        $data['password'] = Hash::make($data['password']);

        return Vendor::create($data);
    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'type' => ['required', 'string', 'In:individual,company'],
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:191'],
            'address' => ['nullable', 'string', 'max:191'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        return User::create([
            'type' => $data['type'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
