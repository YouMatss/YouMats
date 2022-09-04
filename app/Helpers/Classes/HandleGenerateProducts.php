<?php


namespace App\Helpers\Classes;

use App\Models\Product;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Trait HandleGenerateProducts
{
    private $result_ar;
    private $result_en;
    private $locales;

    public function __construct()
    {
        $this->locales = LaravelLocalization::getSupportedLanguagesKeys();
    }

    private function handleModels($model) {
        $sentences = [
            'name' => (new GenerateSentence())->printf($this->reformat($model->template)),
            'desc' => (new GenerateSentence())->printf($this->reformat($this->handleDesc($model, 'desc')), true),
            'short_desc' => (new GenerateSentence())->printf($this->reformat($this->handleDesc($model, 'short_desc')), true)
        ];

        $arr = $this->combine($sentences);
        foreach ($arr as $row) {

            $product = Product::create([
                'category_id' => $model->category_id,
                'vendor_id' => $model->vendor_id,
                'name' => $row['name'],
                'desc' => $row['desc'],
                'short_desc' => $row['short_desc'],
                'rate' => 5,
                'type' => 'product',
                'price' => 0,
                'cost' => 0,
                'stock' => 1000,
                'SKU' => Str::sku('yt', '-'),
                'active' => 0,
                'slug' => Str::slug($row['name']['en'], '-') . rand(100, 999),
                'sort' => 0
            ]);

            //Add images to the product
//            foreach($model->getMedia(GENERATE_PRODUCT_PATH) as $image) {
//                $product->addMediaFromUrl($image->getUrl())->toMediaCollection(PRODUCT_PATH);
//            }

        }
    }


    private function reformat($data) {
        $formattedData = [];
        $values = [];
        $maxLength = 1;

        foreach ($this->locales as $locale) {
            foreach ($data[$locale] as $item) {
                $tempValue = explode('-', $item['value']);
                if($maxLength < count($tempValue)) {
                    $maxLength = count($tempValue);
                }
                $values[$locale][] = $tempValue;
            }
        }

        foreach ($this->locales as $locale) {
            foreach ($values[$locale] as $key => $value) {
                if(count($value) < $maxLength) {
                    $formattedData[$locale][$key] = $value;
                    for ($i = count($value); $i < $maxLength; $i++) {
                        $formattedData[$locale][$key][$i] = '';
                    }
                } else {
                    $formattedData[$locale][$key] = $value;
                }
            }
        }

        return [
            'data' => $formattedData,
            'maxLength' => $maxLength
        ];
    }

    private function combine($arr) {
        $result = [];

        for ($i = 0; $i < count($arr['name']['ar']); $i++) {
            $result[$i]['name']['ar'] = $arr['name']['ar'][$i];
            $result[$i]['name']['en'] = $arr['name']['en'][$i];
            $result[$i]['desc']['ar'] = $arr['desc']['ar'][$i];
            $result[$i]['desc']['en'] = $arr['desc']['en'][$i];
            $result[$i]['short_desc']['ar'] = $arr['short_desc']['ar'][$i];
            $result[$i]['short_desc']['en'] = $arr['short_desc']['en'][$i];
        }
        return $result;
    }

    private function getOrderedValues($template) {
        $result = [];
        foreach ($this->locales as $locale) {
            foreach ($template[$locale] as $row) {
                if($row['order'])
                    $result[$locale][$row['order']] = $row['value'];
            }
        }
        return $result;
    }

    private function handleDesc($model, $attr) {
        $orderedValues = $this->getOrderedValues($model->template);
        $result = [];
        foreach ($this->locales as $locale) {
            foreach (explode('##', strip_tags($model->getTranslation($attr, $locale))) as $row) {
                if(is_numeric($row)) {
                    $result[$locale][]['value'] = $orderedValues[$locale][$row];
                } elseif(!empty($row)) {
                    $result[$locale][]['value'] = $row;
                }
            }
        }
        return $result;
    }
}
