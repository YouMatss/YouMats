<?php

namespace App\Http\Controllers\Front\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Vendor;
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

    /**
     * @param $vendor
     */
    protected function checkPermissions($vendor)
    {
        if(!$vendor->active)
            return back()->with(['custom_warning' => __('You do not have permissions to access this page')]);
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
            'subCategory_id' => REQUIRED_NUMERIC_VALIDATION,
            'type' => 'required|in:product,service',
            'price' => 'required_if:type,product|numeric',
            'stock' => 'required_if:type,product|numeric',
            'unit' => 'required_if:type,product|string|max:191',
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
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    protected function setProduct(Request $request, Product $product)
    {
        $slug = Str::slug($request->name_en, '-');
        $product->subCategory_id = $request->subCategory_id;
        $product->slug = $slug;
        $product->type = $request->type;
        $product->rate = $request->rate;

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
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->unit = $request->unit;
        }
    }

    /**
     * @param Vendor $vendor
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(Vendor $vendor)
    {
        $this->checkPermissions($vendor);

        $subCategories = SubCategory::all();

        return view('front.vendor.product.create', [
            'vendor' => $vendor,
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @param Vendor $vendor
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(Request $request, Vendor $vendor): RedirectResponse
    {
        $this->checkPermissions($vendor);

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

        $this->setProduct($request, $product);

        //Add gallery to the product
        foreach($request->gallery as $image) {
            $product->addMedia($image)->toMediaCollection(PRODUCT_PATH);
        }

        //Save the product
        $product->save();

        return redirect()->route('vendor.edit', [
            'vendor' => $vendor
        ])
        ->with([
            'custom_success' => __('Product has been added.')
        ]);
    }

    /**
     * @param Vendor $vendor
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Vendor $vendor, Product $product)
    {
        $this->checkPermissions($vendor);

        $subCategories = SubCategory::all();

        return view('front.vendor.product.edit', [
            'vendor' => $vendor,
            'product' => $product,
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @param Vendor $vendor
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(Request $request, Vendor $vendor, Product $product): RedirectResponse
    {
        $this->checkPermissions($vendor);

        $this->validateRequest($request);

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

        return redirect()->back()
        ->with([
            'custom_success' => __('Product has been updated.')
        ]);
    }

    /**
     * @param Product $product
     * @param Media $media
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteImage(Product $product, Media $media): JsonResponse
    {
        $this->checkPermissions(Auth::guard('vendor')->user());

        if(count($product->getMedia(PRODUCT_PATH)) === 1)
            return response()->json(['status' => false, 'message' => __('You cannot delete the only image of this product.')]);

        $media::where('model_id', $product->id)
                ->where('model_type', 'App\Models\Product')
                ->where('id', $media->id)
                ->delete();

        return response()->json(['status' => true, 'message' => __('Image has been removed.')]);
    }
}
