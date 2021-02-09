<?php


namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:vendor')->except('index');
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

        return view('front.vendor.edit', ['vendor' => $vendor]);
    }
}
