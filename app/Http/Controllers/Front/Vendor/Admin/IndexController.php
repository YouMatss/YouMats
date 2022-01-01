<?php


namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorRequest;
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
use Illuminate\Support\Facades\Session;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class IndexController extends Controller
{
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
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
     * @param VendorRequest $request
     * @return RedirectResponse
     */
    public function update(VendorRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $vendor = Auth::guard('vendor')->user();

        if(isset($data['logo'])) {
            //Delete previously created logos
            $vendor->clearMediaCollectionExcept(VENDOR_LOGO);
            //Add new logo!
            $vendor->addMedia($data['logo'])->toMediaCollection(VENDOR_LOGO);
        }
        if(isset($data['cover'])) {
            //Delete previously created covers
            $vendor->clearMediaCollectionExcept(VENDOR_COVER);
            //Add new cover!
            $vendor->addMedia($data['cover'])->toMediaCollection(VENDOR_COVER);
        }

        //Tweak the system to create a new password for the vendor only if its set.
        if(isset($data['password']))
            $data['password'] = Hash::make($data['password']);
        else
            unset($data['password']);

        $vendor->setTranslation('name', 'en', $data['name_en']);
        $vendor->setTranslation('name', 'ar', $data['name_ar']);

        if(isset($data['contacts_person_name'])) {
            for ($i=0;$i<count($data['contacts_person_name']);$i++) {
                $data['contacts'][] = [
                    'person_name' => $data['contacts_person_name'][$i],
                    'email' => $data['contacts_email'][$i],
                    'phone' => $data['contacts_phone'][$i],
                    'cities' => 1,
//                    'cities' => $data['contacts_cities'][$i],
                    'with' => $data['contacts_with'][$i],
                ];
            }
        } else {
            $data['contacts'] = [];
        }

        $vendor->update($data);

        // Add licenses to the vendor
        if(isset($data['licenses'])) {
            foreach($data['licenses'] as $license) {
                $vendor->addMedia($license)->toMediaCollection(VENDOR_PATH);
            }
        }

        Session::flash('success', __('vendorAdmin.success_update_vendor'));
        return redirect()->back();
    }
}
