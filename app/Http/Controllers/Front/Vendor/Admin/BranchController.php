<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\VendorBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['branches'] = $data['vendor']->branches()->paginate(10);

        return view('vendorAdmin.branch.index')->with($data);
    }

    public function create() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['cities'] = City::where('country_id', $data['vendor']->country_id)->get();

        return view('vendorAdmin.branch.create')->with($data);
    }

    public function store() {}

    public function edit($branch_id) {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['branch'] = VendorBranch::where([
            'id' => $branch_id,
            'vendor_id' => $data['vendor']->id
        ])->firstorfail();
        $data['cities'] = City::where('country_id', $data['vendor']->country_id)->get();

        return view('vendorAdmin.branch.edit')->with($data);
    }

    public function update() {}

    public function delete() {}
}
