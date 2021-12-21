<?php

namespace App\Http\Controllers\Front\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
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
}
