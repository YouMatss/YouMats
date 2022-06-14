<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\ProductRequest;
use App\Models\Admin;
use App\Models\Attribute;
use App\Models\City;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Unit;
use App\Models\Vendor;
use App\Notifications\OrderCreated;
use App\Notifications\ProductCreated;
use App\Notifications\ProductUpdated;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');

        //If you would like to add "vendor verification middleware":
        $this->middleware('verified:vendor.verification.notice');
    }

    public function index() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['products'] = $data['vendor']->products;

        return view('vendorAdmin.product.index')->with($data);
    }

    public function create()
    {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['categories'] = Category::whereIsRoot()->get();
        $data['units'] = Unit::orderby('sort')->get();
        $data['cities'] = City::where('country_id', $data['vendor']->country_id)->get();

        return view('vendorAdmin.product.create')->with($data);
    }

    public function store(Request $request)
    {
        dd($request->all());

        $data = $request->validated();
        $data['vendor_id'] = Auth::guard('vendor')->id();

        $data['slug'] = Str::slug(implode(' ', $data['name_en']), '-') . rand(100, 999);

        if(Product::whereSlug($data['slug'])->exists())
            $data['slug'] = Str::slug(implode(' ', $data['name_en']), '-') . rand(100, 999);

        $data['active'] = 0;

        if(isset($data['specific_shipping']) && $data['specific_shipping']) {
            $data['specific_shipping'] = '1';
        } else {
            $data['specific_shipping'] = '0';
        }

        if(gettype($data['name_en']) == 'array') {
            $data['name'] = ['en' => implode(' ', $data['name_en']), 'ar' => implode(' ', $data['name_ar'])];
            $data['temp_name'] = ['en' => implode('-', $data['name_en']), 'ar' => implode('-', $data['name_ar'])];
            $data['meta_title'] = ['en' => implode(' ', $data['name_en']), 'ar' => implode(' ', $data['name_ar'])];
            $data['meta_keywords'] = ['en' => implode(' ', $data['name_en']), 'ar' => implode(' ', $data['name_ar'])];
        } else {
            $data['name'] = ['en' => $data['name_en'], 'ar' => $data['name_ar']];
            $data['meta_title'] = ['en' => $data['name_en'], 'ar' => $data['name_ar']];
            $data['meta_keywords'] = ['en' => $data['name_en'], 'ar' => $data['name_ar']];
        }
        $data['desc'] = ['en' => $data['desc_en'], 'ar' => $data['desc_ar']];
        $data['short_desc'] = ['en' => $data['short_desc_en'], 'ar' => $data['short_desc_ar']];
        $data['meta_desc'] = ['en' => $data['short_desc_en'], 'ar' => $data['short_desc_ar']];

        if(isset($data['shipping_cities'])) {
            for ($i=0;$i<count($data['shipping_cities']);$i++) {
                $data['shipping_prices'][] = [
                    'cities' => $data['shipping_cities'][$i],
                    'price' => $data['shipping_price'][$i],
                    'time' => $data['shipping_time'][$i],
                    'format' => $data['shipping_format'][$i],
                ];
            }
        } else {
            $data['shipping_prices'] = null;
        }

        if(isset($data['attributes'])) {
            $data['attributes'] = '[' . implode(',', $data['attributes']) . ']';
        } else {
            $data['attributes'] = '[]';
        }

        $product = Product::create($data);

        foreach(Admin::all() as $admin)
            $admin->notify(new ProductCreated(Auth::guard('vendor')->user(), $product));

        //Add gallery to the product
        foreach($data['gallery'] as $image) {
            $product->addMedia($image)->toMediaCollection(PRODUCT_PATH);
        }

        Session::flash('success', __('vendorAdmin.success_store_product'));
        return redirect()->route('vendor.product.index');
    }

    public function edit($id)
    {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['product'] = Product::where('id', $id)->where('vendor_id', $data['vendor']->id)->firstorfail();
        $data['categories'] = Category::whereIsRoot()->get();
        $data['units'] = Unit::orderby('sort')->get();
        $data['cities'] = City::where('country_id', $data['vendor']->country_id)->get();
        $data['selected_category'] = Category::findorfail($data['product']->category_id)->parent_id;
        $data['attributes'] = Attribute::with('values')
            ->where('category_id', $data['product']->category_id)->get();

        return view('vendorAdmin.product.edit')->with($data);
    }

    public function update(ProductRequest $request, $product_id)
    {
        $data = $request->validated();
        $vendor_id = Auth::guard('vendor')->id();

        $product = Product::where('id', $product_id)->where('vendor_id', $vendor_id)->firstorfail();

        //Deactivate the product.
        $data['active'] = 0;

        if(gettype($data['name_en']) == 'array') {
            $data['name'] = ['en' => implode(' ', $data['name_en']), 'ar' => implode(' ', $data['name_ar'])];
            $data['temp_name'] = ['en' => implode('-', $data['name_en']), 'ar' => implode('-', $data['name_ar'])];
        } else {
            $data['name'] = ['en' => $data['name_en'], 'ar' => $data['name_ar']];
        }
        $data['desc'] = ['en' => $data['desc_en'], 'ar' => $data['desc_ar']];
        $data['short_desc'] = ['en' => $data['short_desc_en'], 'ar' => $data['short_desc_ar']];

        if(isset($data['specific_shipping']) && $data['specific_shipping']) {
            $data['specific_shipping'] = '1';
        } else {
            $data['specific_shipping'] = '0';
        }

        if(isset($data['shipping_cities'])) {
            for ($i=0;$i<count($data['shipping_cities']);$i++) {
                $data['shipping_prices'][] = [
                    'cities' => $data['shipping_cities'][$i],
                    'price' => $data['shipping_price'][$i],
                    'time' => $data['shipping_time'][$i],
                    'format' => $data['shipping_format'][$i],
                ];
            }
        } else {
            $data['shipping_prices'] = null;
        }

        if(!isset($data['attributes'])) {
            $data['attributes'] = [];
        }

        $product->update($data);

        foreach(Admin::all() as $admin)
            $admin->notify(new ProductUpdated(Auth::guard('vendor')->user(), $product));

        //Add gallery to the product
        if(isset($data['gallery']))
            foreach($data['gallery'] as $image) {
                $product->addMedia($image)->toMediaCollection(PRODUCT_PATH);
            }

        Session::flash('success', __('vendorAdmin.success_update_product'));
        return redirect()->back();
    }

    public function deleteImage(Product $product, Media $image)
    {
        $vendor_id = Auth::guard('vendor')->id();

        if($product->vendor_id != $vendor_id || $image->model_id != $product->id || $image->model_type != 'App\Models\Product') {
            Session::flash('error', __('vendorAdmin.something_went_wrong'));
            return redirect()->back();
        }
        if(count($product->getMedia(PRODUCT_PATH)) <= 1) {
            Session::flash('error', __('vendorAdmin.cannot_delete_only_image'));
            return redirect()->back();
        }

        $product->deleteMedia($image->id);

        Session::flash('success', __('vendorAdmin.success_image_removed'));
        return redirect()->back();
    }
}
