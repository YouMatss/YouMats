<?php

namespace App\Http\Controllers\Front\Vendor;

use App\Helpers\Classes\CollectionPaginate;
use App\Http\Controllers\Controller;
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
    public function index()
    {
        // Get all vendors
        $vendors = Vendor::all()->sortByDesc('subscribe')->groupBy('subscribe')->map(function (Collection $collection) {
            return $collection->sortByDesc('id');
        })->ungroup()->unique();

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
        $data['vendor'] = Vendor::where('slug', $vendor_slug)->firstorfail();
        $data['products'] = $data['vendor']->products()->paginate(20);
        $data['branches'] = $data['vendor']->branches()->paginate(5);

        $widget_data = get_widget_data_by_vendor($data['vendor']);

        $data['widget_phone'] = $widget_data['widget_phone'];
        $data['widget_whatsapp'] = $widget_data['widget_whatsapp'];

        return view('front.vendor.show')->with($data);
    }
}
