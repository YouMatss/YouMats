<?php

namespace App\Http\Controllers\Front\Vendor\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Unit;
use App\Models\Vendor;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth:vendor');
        $this->middleware('verified:vendor.verification.notice');
    }

    public function index() {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['products'] = $data['vendor']->products()->paginate(10);

        return view('vendorAdmin.product.index')->with($data);
    }

    public function create()
    {
        $data['vendor'] = Auth::guard('vendor')->user();
        $data['tags'] = Tag::all();
        $data['categories'] = Category::all();
        $data['units'] = Unit::orderby('sort')->get();

        return view('vendorAdmin.product.create')->with($data);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function validateRequest(Request $request): array
    {
        return $request->validate([
            'name_en' => REQUIRED_STRING_VALIDATION,
            'name_ar' => REQUIRED_STRING_VALIDATION,
            'category_id' => REQUIRED_NUMERIC_VALIDATION,
            'type' => 'required|in:product,service',
            'price' => 'required_if:type,product|numeric',
            'stock' => 'required_if:type,product|numeric',
            'unit_id' => 'integer|exists:units,id',
            'rate' => REQUIRED_NUMERIC_VALIDATION,
            'short_desc_en' => NULLABLE_TEXT_VALIDATION,
            'short_desc_ar' => NULLABLE_TEXT_VALIDATION,
            'desc_en' => NULLABLE_TEXT_VALIDATION,
            'desc_ar' => NULLABLE_TEXT_VALIDATION
        ]);
    }

    /**
     * @param Request $request
     * @param Product $product
     */
    protected function setProduct(Request $request, Product $product)
    {
        $slug = Str::slug($request->name_en, '-');
        $product->category_id = $request->category_id;
        $product->slug = $slug;
        $product->type = $request->type;
        $product->rate = $request->rate;
        $product->unit_id = $request->unit_id;

        //Generate translations
        $product->setTranslation('name', 'en', $request->name_en);
        $product->setTranslation('name', 'ar', $request->name_ar);
        $product->setTranslation('desc', 'en', $request->desc_en);
        $product->setTranslation('desc', 'ar', $request->desc_ar);
        $product->setTranslation('meta_title', 'en', $request->name_en);
        $product->setTranslation('meta_title', 'ar', $request->name_ar);
        $product->setTranslation('meta_desc', 'en', $request->name_en);
        $product->setTranslation('meta_desc', 'ar', $request->name_ar);
        $product->setTranslation('meta_keywords', 'en', $request->name_en);
        $product->setTranslation('meta_keywords', 'ar', $request->name_ar);
        $product->setTranslation('short_desc', 'en', $request->short_desc_en);
        $product->setTranslation('short_desc', 'ar', $request->short_desc_ar);


        //If it's a product let's set the price/stock/unit!
        if($request->type == 'product') {
            $product->cost = $request->cost;
            $product->price = $request->price;
            $product->stock = $request->stock;
        }
    }

    /**
     * @param Request $request
     * @param Vendor $vendor
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(Request $request): RedirectResponse
    {
        $vendor = Auth::guard('vendor')->user();

        if(!$vendor->active)
            return redirect()->route('vendor.edit')->with(['custom_warning' => __('You do not have permissions to access this page')]);

        $this->validateRequest($request);

        $slug = Str::slug($request->name_en, '-');

        $request->validate([
            'gallery' => 'required|array',
            'gallery.*' => REQUIRED_IMAGE_VALIDATION
        ]);

        if(Product::whereSlug($slug)->exists())
            return back()->with(['custom_error' => __('Slug already exists. Change the name.')])->withInput($request->except('_token'));

        $product = new Product();
        //Generate SKU
        $product->sku = Str::sku($request->name_en, '-');
        $product->vendor_id = $vendor->id;
        $product->best_seller = 0;
        $product->active = 0;

        $this->setProduct($request, $product);

        //Add gallery to the product
        foreach($request->gallery as $image) {
            $product->addMedia($image)->toMediaCollection(PRODUCT_PATH);
        }

        //Save the product
        $product->save();

        return redirect()->route('vendor.edit')
        ->with([
            'custom_success' => __('Product has been added.')
        ]);
    }

    /**
     * @param Vendor $vendor
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product)
    {
        $vendor = Auth::guard('vendor')->user();

        if(!$vendor->active)
            return redirect()->route('vendor.edit')->with(['custom_warning' => __('You do not have permissions to access this page')]);

        if($product->vendor_id !== $vendor->id)
            return back()->with(['custom_warning' => __('You do not have permissions to edit this product.')]);

        $categories = Category::all();
        $units = Unit::orderBy('sort')->get();

        return view('front.vendor.product.edit', [
            'product' => $product,
            'categories' => $categories,
            'units' => $units
        ]);
    }

    /**
     * @param Request $request
     * @param Vendor $vendor
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $vendor = Auth::guard('vendor')->user();

        if(!$vendor->active)
            return redirect()->route('vendor.edit')->with(['custom_warning' => __('You do not have permissions to access this page')]);

        if($product->vendor_id !== $vendor->id)
            return back()->with(['custom_warning' => __('You do not have permissions to edit this product.')]);

        $this->validateRequest($request);

        $data = $this->validate($request, [
            'cities' => ARRAY_VALIDATION,
            'cities.*' => 'required|integer|exists:cities,id',
            'price_shipping' => ARRAY_VALIDATION,
            'price_shipping.*' => REQUIRED_INTEGER_VALIDATION,
            'time' => ARRAY_VALIDATION,
            'time.*' => REQUIRED_INTEGER_VALIDATION,
            'format' => ARRAY_VALIDATION,
            'format.*' => 'required|string|In:hour,day',
        ]);

        if($product->SKU != $request->sku) {
            $request->validate([
                'sku' => 'required|string|unique:products'
            ]);

            $product->SKU = $request->sku;
        }

        $this->setProduct($request, $product);

        //Deactivate the product.
        $product->active = 0;

        $product->save();

        //Add gallery to the product
        if(isset($request->gallery))
            foreach($request->gallery as $image) {
                $product->addMedia($image)->toMediaCollection(PRODUCT_PATH);
            }

        $shippingPrices = [];

        for ($i=0;$i<count($data['cities']);$i++) {
            $shippingPrices[$i]['cities'] = $data['cities'][$i];
            $shippingPrices[$i]['price'] = $data['price_shipping'][$i];
            $shippingPrices[$i]['time'] = $data['time'][$i];
            $shippingPrices[$i]['format'] = $data['format'][$i];
        }

        $product->update([
            'shipping_prices' => $shippingPrices
        ]);

        return redirect()->back()->with([
            'custom_success' => __('Product has been updated.')
        ]);
    }

    /**
     * @param Product $product
     * @param Media $media
     * @return JsonResponse|RedirectResponse
     * @throws Exception
     */
    public function deleteImage(Product $product, Media $media)
    {
        if(!Auth::guard('vendor')->user()->active)
            return redirect()->route('vendor.edit')->with(['custom_warning' => __('You do not have permissions to access this page')]);

        if(count($product->getMedia(PRODUCT_PATH)) === 1)
            return response()->json(['status' => false, 'message' => __('You cannot delete the only image of this product.')]);

        $media::where('model_id', $product->id)
                ->where('model_type', 'App\Models\Product')
                ->where('id', $media->id)
                ->delete();

        return response()->json(['status' => true, 'message' => __('Image has been removed.')]);
    }
}
