<?php


namespace App\Http\Controllers\Front\Vendor;

use App\Http\Controllers\Controller;
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

class IndexController extends Controller
{
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:vendor')->except('index', 'show');

        //If you would like to add "vendor verification middleware":
        $this->middleware('verified:vendor.verification.notice')->except('index', 'show');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        // Get all vendors
        $vendors = Vendor::paginate(21);

        // Return the vendors to the view.
        // So we can loop through
        return view('front.vendor.index', ['vendors' => $vendors]);
    }

    /**
     * @param $vendor_slug
     * @return Application|Factory|View
     */
    public function show($vendor_slug) {
        $vendor = Vendor::where('slug', $vendor_slug)->firstorfail();
        $products = $vendor->products()->paginate(20);
        $branches = $vendor->branches()->paginate(5);
        return view('front.vendor.show', ['vendor' => $vendor, 'products' => $products, 'branches' => $branches]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(Request $request)
    {
        $vendor = Auth::guard('vendor')->user();

        $products = $vendor->products()->paginate(20);
        $branches = $vendor->branches()->paginate(5);
        $order_items = $vendor->order_items;

        return view('front.vendor.edit', ['vendor' => $vendor, 'products' => $products, 'branches' => $branches, 'items' => $order_items]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->validate([
            'name_en' => REQUIRED_TEXT_VALIDATION,
            'name_ar' => REQUIRED_TEXT_VALIDATION,
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

        $vendor->setTranslation('name', 'en', $request->name_en);
        $vendor->setTranslation('name', 'ar', $request->name_ar);

        $vendor->update($request->except('name_en', 'name_ar', '_token', 'password'));

        return back()->with(['custom_success' => __('Profile has been updated successfully')]);

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
            return response(['status' => false, 'custom_warning' => __('Your account is not activated')]);

        $data = $request->validate([
            'name' => REQUIRED_STRING_VALIDATION,
            'phone_number' => REQUIRED_STRING_VALIDATION,
            'fax' => NULLABLE_STRING_VALIDATION,
            'website' => NULLABLE_STRING_VALIDATION,
            'address' => REQUIRED_STRING_VALIDATION,
            'latitude' => REQUIRED_STRING_VALIDATION,
            'longitude' => REQUIRED_STRING_VALIDATION
        ]);

        $data['vendor_id'] = $vendor->id;

        VendorBranch::create($data);

        return response()->json(['status' => true, 'message' => __('Branch has been added successfully')]);
    }

    /**
     * @param VendorBranch $branch
     * @return RedirectResponse
     * @throws Exception
     */
    public function deleteBranch(VendorBranch $branch): RedirectResponse
    {
        $branch->delete();

        return back()->with(['custom_success' => __('Branch has been deleted successfully')]);
    }
}
