<?php


namespace App\Http\Controllers\Front\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:vendor')->except('index');

        //If you would like to add "vendor verification middleware":
        $this->middleware('verified:vendor.verification.notice')->except('index');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        // Get all vendors
        $vendors = Vendor::paginate(20);

        // Return the vendors to the view.
        // So we can loop through
        return view('front.vendor.index', ['vendors' => $vendors]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendorProducts = $vendor->products()->paginate(20);

        return view('front.vendor.edit', ['vendor' => $vendor, 'vendorProducts' => $vendorProducts]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->validate([
            'name' => REQUIRED_TEXT_VALIDATION,
            'email' => REQUIRED_EMAIL_VALIDATION,
            'logo' => NULLABLE_IMAGE_VALIDATION,
            'cover' => NULLABLE_IMAGE_VALIDATION,
            'phone' => NULLABLE_STRING_VALIDATION,
            'phone2' => NULLABLE_STRING_VALIDATION,
            'whatsapp_phone' => NULLABLE_STRING_VALIDATION,
            'address' => NULLABLE_STRING_VALIDATION,
            'address2' => NULLABLE_STRING_VALIDATION,
            'location' => NULLABLE_TEXT_VALIDATION,
            'facebook_url' => NULLABLE_STRING_VALIDATION,
            'twitter_url' => NULLABLE_STRING_VALIDATION,
            'youtube_url' => NULLABLE_STRING_VALIDATION,
            'instagram_url' => NULLABLE_STRING_VALIDATION,
            'pinterest_url' => NULLABLE_STRING_VALIDATION,
            'website_url' => NULLABLE_STRING_VALIDATION,
            'password' => NULLABLE_PASSWORD_VALIDATION
        ]);

        $vendor = Vendor::findOrFail($id);

        if(isset($request->logo)) {
            //Delete previously created logos
            $vendor->clearMediaCollectionExcept(VENDOR_LOGO);
            //Add new logo!
            $vendor->addMedia($request->logo)->toMediaCollection(VENDOR_LOGO);
        }
        if(isset($request->cover)) {
            //Delete previously created covers
            $vendor->clearMediaCollectionExcept(VENDOR_COVER);
            //Add new cover!
            $vendor->addMedia($request->cover)->toMediaCollection(VENDOR_COVER);
        }

        //Tweak the system to create a new password for the vendor only if its set.
        if(isset($request->password))
            $data['password'] = Hash::make($request->password);
        else
            unset($data['password']);

        $vendor->update($data);

        return back()->with(['message' => __('Profile has been updated successfully')]);

    }
}
