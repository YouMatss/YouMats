<?php


namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Vendor;
use App\Models\VendorBranch;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class IndexController extends Controller
{
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:vendor');

        //If you would like to add "vendor verification middleware":
        $this->middleware('verified:vendor.verification.notice');
    }

    public function dashboard() {
        $data['vendor'] = Auth::guard('vendor')->user();

        return view('vendorAdmin.dashboard')->with($data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(Request $request)
    {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['cities'] = City::where('country_id', $data['vendor']->country_id)->get();

        return view('vendorAdmin.edit')->with($data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name_en' => REQUIRED_TEXT_VALIDATION,
            'name_ar' => REQUIRED_TEXT_VALIDATION,
            'email' => REQUIRED_EMAIL_VALIDATION,
            'address' => NULLABLE_STRING_VALIDATION,
            'type' => [...NULLABLE_STRING_VALIDATION, 'In:factory,distributor,wholesales,retail'],
            'logo' => NULLABLE_IMAGE_VALIDATION,
            'cover' => NULLABLE_IMAGE_VALIDATION,
            'contacts' => REQUIRED_ARRAY_VALIDATION,
            'contacts.*.person_name' => REQUIRED_STRING_VALIDATION,
            'contacts.*.phone' => REQUIRED_STRING_VALIDATION,
            'contacts.*.email' => REQUIRED_STRING_VALIDATION,
            'contacts.*.position' => NULLABLE_STRING_VALIDATION,
            'latitude' => REQUIRED_STRING_VALIDATION,
            'longitude' => REQUIRED_STRING_VALIDATION,
            'facebook_url' => NULLABLE_URL_VALIDATION,
            'twitter_url' => NULLABLE_URL_VALIDATION,
            'youtube_url' => NULLABLE_URL_VALIDATION,
            'instagram_url' => NULLABLE_URL_VALIDATION,
            'pinterest_url' => NULLABLE_URL_VALIDATION,
            'website_url' => NULLABLE_URL_VALIDATION,
            'password' => NULLABLE_PASSWORD_VALIDATION,
            'licenses' => ARRAY_VALIDATION,
            'licenses.*' => REQUIRED_IMAGE_VALIDATION
        ]);

        $vendor = Vendor::findOrFail($request->id);

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

        $vendor->setTranslation('name', 'en', $request->name_en);
        $vendor->setTranslation('name', 'ar', $request->name_ar);

        $vendor->update($request->except('name_en', 'name_ar', '_token', 'password'));

        // Add licenses to the vendor
        if(isset($request->licenses))
            foreach($request->licenses as $license) {
                $vendor->addMedia($license)->toMediaCollection(VENDOR_PATH);
            }

        return back()->with(['custom_success' => __('vendor.profile_updated')]);
    }

    /**
     * @param Request $request
     * @param Vendor $vendor
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function addBranch(Request $request)
    {
        $vendor = Auth::guard('vendor')->user();

        if(!$vendor->active)
            return response(['status' => false, 'custom_warning' => __('vendor.account_not_active')]);

        $data = $request->validate([
            'name' => REQUIRED_STRING_VALIDATION,
            'city_id' => 'required|integer|exists:cities,id',
            'phone_number' => REQUIRED_STRING_VALIDATION,
            'fax' => NULLABLE_STRING_VALIDATION,
            'website' => NULLABLE_URL_VALIDATION,
            'address' => REQUIRED_STRING_VALIDATION,
            'latitude' => NULLABLE_STRING_VALIDATION,
            'longitude' => NULLABLE_STRING_VALIDATION
        ]);

        $data['vendor_id'] = $vendor->id;
        if(isset($data['phone_number']))
            $data['phone_number'] = $data['phone_number'];

        VendorBranch::create($data);

        return response()->json(['status' => true, 'message' => __('vendor.branch_added')]);
    }

    /**
     * @param VendorBranch $branch
     * @return RedirectResponse
     * @throws Exception
     */
    public function deleteBranch(VendorBranch $branch): RedirectResponse
    {
        $branch->delete();

        return back()->with(['custom_success' => __('vendor.branch_deleted')]);
    }

    public function deleteLicense(Vendor $vendor, Media $media)
    {
        if(!Auth::guard('vendor')->user()->active)
            return redirect()->route('vendor.edit')->with(['custom_warning' => __('vendor.no_permissions')]);

        if(count($vendor->getMedia(VENDOR_PATH)) === 1)
            return response()->json(['status' => false, 'message' => __('vendor.default_license_needed')]);

        $media::where('model_id', $vendor->id)
            ->where('model_type', 'App\Models\Vendor')
            ->where('id', $media->id)
            ->delete();

        return response()->json(['status' => true, 'message' => __('vendor.license_removed.')]);
    }

    public function updateShippingPrices(Request $request) {
        $data = $this->validate($request, [
            'id' => 'required|integer|exists:vendors,id',
            'cities' => ARRAY_VALIDATION,
            'cities.*' => 'required|integer|exists:cities,id',
            'price' => ARRAY_VALIDATION,
            'price.*' => REQUIRED_INTEGER_VALIDATION,
            'time' => ARRAY_VALIDATION,
            'time.*' => REQUIRED_INTEGER_VALIDATION,
            'format' => ARRAY_VALIDATION,
            'format.*' => 'required|string|In:hour,day',
        ]);

        $vendor = Vendor::findorfail($data['id']);

        $shippingPrices = [];

        for ($i=0;$i<count($data['cities']);$i++) {
            $shippingPrices[$i]['cities'] = $data['cities'][$i];
            $shippingPrices[$i]['price'] = $data['price'][$i];
            $shippingPrices[$i]['time'] = $data['time'][$i];
            $shippingPrices[$i]['format'] = $data['format'][$i];
        }

        $vendor->update([
            'shipping_prices' => $shippingPrices
        ]);
        return back()->with(['custom_success' => __('vendor.shipping_prices_updated')]);
    }
}
