<?php


namespace App\Http\Controllers\Front;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class VendorController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('front.vendor.index');
    }
}
