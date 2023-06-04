<?php

namespace App\Http\Controllers\Front\Vendor;

use App\Helpers\Classes\CollectionPaginate;
use App\Helpers\Classes\Log;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class IndexController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index() {
        // Get all vendors

/*
        $vendors = Vendor::all()->with('current_subscribes')
        ->sortByDesc('subscribe')
        ->groupBy('subscribe')
        ->map(function (Collection $collection) {
            return $collection->sortByDesc('id');
        })->ungroup()->unique();
*/

        $vendors = Vendor::with('media', 'current_subscribes')->where('active', true)->orderBy('created_at')->get();


        $vendors = CollectionPaginate::paginate($vendors, 21);
        $vendors->withPath(url()->current())->withQueryString();

        // Return the vendors to the view.
        // So we can loop through
        return view('front.vendor.index', ['vendors' => $vendors]);
    }

    /**
     * @param $vendor_slug
     * @return Application|Factory|View
     */
    public function show($vendor_slug) {
        $data['vendor']   = Vendor::with('current_subscribes')->where('slug', $vendor_slug)->firstorfail();
        $data['products'] = $data['vendor']->products()->paginate(20);
        $data['branches'] = $data['vendor']->branches()->paginate(5);

        if ($data['vendor']->subscribe && !$data['vendor']->manage_by_admin && $data['vendor']->contacts) {
            $data['widget_phone'] = Clean_Phone_Number($data['vendor']->call_phone());
            $data['widget_whatsapp'] = $data['vendor']->whatsapp_message();
        }

        Log::set('visit', [Vendor::class, $data['vendor']->id]);

        return view('front.vendor.show')->with($data);
    }
}
