<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return Product|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|null
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function model(array $row)
    {
        $row['search_keywords_en'] = json_decode($row['search_keywords_en']);
        $row['search_keywords_ar'] = json_decode($row['search_keywords_ar']);
        $row['images'] = json_decode($row['images']);

        $data = Validator::make($row, [
            'name_en' => REQUIRED_STRING_VALIDATION,
            'name_ar' => REQUIRED_STRING_VALIDATION,

            'category_id' => [...REQUIRED_INTEGER_VALIDATION, ...['exists:categories,id']],
            'vendor_id' => [...REQUIRED_INTEGER_VALIDATION, ...['exists:vendors,id']],

            'desc_en' => NULLABLE_TEXT_VALIDATION,
            'desc_ar' => NULLABLE_TEXT_VALIDATION,

            'short_desc_en' => NULLABLE_TEXT_VALIDATION,
            'short_desc_ar' => NULLABLE_TEXT_VALIDATION,

            'rate' => [...REQUIRED_INTEGER_VALIDATION, ...['between:1,5']],
            'price' => REQUIRED_NUMERIC_VALIDATION,
            'stock' => REQUIRED_INTEGER_VALIDATION,
            'min_quantity' => NULLABLE_INTEGER_VALIDATION,

            'shipping_id' => [...NULLABLE_INTEGER_VALIDATION, ...['exists:shippings,id']],

            'search_keywords_en' => ARRAY_VALIDATION,
            'search_keywords_en.*' => REQUIRED_STRING_VALIDATION,
            'search_keywords_ar' => ARRAY_VALIDATION,
            'search_keywords_ar.*' => REQUIRED_STRING_VALIDATION,

            'images' => ARRAY_VALIDATION,
            'images.*' => REQUIRED_URL_VALIDATION
        ]);

        if($data->fails()) {
            return null;
        } else {
            $data = $data->validated();
        }

        $product = new Product();

        $product->category_id = $data['category_id'];
        $product->vendor_id = $data['vendor_id'];
        $product->name = ['en' => $data['name_en'], 'ar' => $data['name_ar']];
        $product->short_desc = ['en' => $data['short_desc_en'], 'ar' => $data['short_desc_ar']];
        $product->desc = ['en' => $data['desc_en'], 'ar' => $data['desc_ar']];
        $product->rate = $data['rate'];
        $product->type = 'product';
        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->min_quantity = $data['min_quantity'] ?? 1;
        $product->SKU = Str::sku('yt', '-');
        $product->shipping_id = $data['shipping_id'];

        $search_keywords_en = '';
        $search_keywords_ar = '';
        foreach ($data['search_keywords_en'] as $key) {
            $search_keywords_en .= $key . '\r\n';
        }
        foreach ($data['search_keywords_ar'] as $key) {
            $search_keywords_ar .= $key . '\r\n';
        }

        $product->search_keywords = ['en' => $search_keywords_en, 'ar' => $search_keywords_ar];

        $product->slug = Str::slug($data['name_en'], '-') . rand(100, 999);
        if (Product::whereSlug($product->slug)->exists())
            $product->slug = Str::slug($data['name_en'], '-') . rand(100, 999);

        $product->meta_title = ['en' => $data['name_en'], 'ar' => $data['name_ar']];
        $product->meta_desc = ['en' => $data['short_desc_en'], 'ar' => $data['short_desc_ar']];
        $product->meta_keywords = ['en' => $data['name_en'], 'ar' => $data['name_ar']];

        if(count($data['images']))
            foreach($data['images'] as $image)
                $product->addMediaFromUrl($image)->toMediaCollection(PRODUCT_PATH);

        return $product;
    }

    /**
     * @return int
     */
    public function headingRow(): int
    {
        return 1;
    }
}
