<?php

namespace App\Nova\Actions;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Password;
use InvalidArgumentException;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class GenerateProductsAction extends Action
{
    use InteractsWithQueue, Queueable;

    private $result_ar;
    private $result_en;
    private $locales;

    public function __construct()
    {
        $this->locales = LaravelLocalization::getSupportedLanguagesKeys();
    }

    /**
     * Perform the action on the given models.
     *
     * @param ActionFields $fields
     * @param Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        if (Hash::check('12345678', $fields['password'])) {
            foreach ($models as $model) {
                $this->handleModels($this->combine($this->printf($this->reformat($model->template))), $model);
            }
        } else {
            throw new InvalidArgumentException('The given password is invalid.');
        }
    }

    private function combine($arr) {
        $result = [];
        for ($i = 0; $i < count($arr['ar']); $i++) {
            $result[$i]['ar'] = $arr['ar'][$i];
            $result[$i]['en'] = $arr['en'][$i];
        }
        return $result;
    }

    private function reformat($template) {
        $formattedTemplate = [];
        $values = [];
        $maxLength = 1;

        foreach ($this->locales as $locale) {
            foreach ($template[$locale] as $item) {
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
                    $formattedTemplate[$locale][$key] = $value;
                    for ($i = count($value); $i < $maxLength; $i++) {
                        $formattedTemplate[$locale][$key][$i] = '';
                    }
                } else {
                    $formattedTemplate[$locale][$key] = $value;
                }
            }
        }

        return [
            'template' => $formattedTemplate,
            'maxLength' => $maxLength
        ];
    }

    private function printf($arr) {
        $output = [];
        $result = [];

        foreach ($this->locales as $locale) {
            for ($i = 0; $i < $arr['maxLength']; $i++) {
                if ($arr['template'][$locale][0][$i] != '')
                    $result[$locale] = $this->printUntil($arr['template'][$locale], count($arr['template'][$locale]), $arr['maxLength'], 0, $i, $output, $locale);
            }
        }

        return $result;
    }

    private function printUntil($template, $templateLength, $maxLength, $m, $n, $output, $locale) {
        $string = '';
        $output[$m] = $template[$m][$n];

        if ($m == $templateLength - 1) {
            for ($i = 0; $i < $templateLength; $i++) {
                if($templateLength - $i == 1)
                    $string .= $output[$i];
                else
                    $string .= $output[$i] . ' ';
            }
            if($locale == 'ar') {
                $this->result_ar[] = $string;
            } elseif($locale == 'en') {
                $this->result_en[] = $string;
            }
            return;
        }

        for ($j = 0; $j < $maxLength; $j++) {
            if (isset($template[$m+1][$j]) && $template[$m+1][$j] != '')
                $this->printUntil($template, $templateLength, $maxLength, $m+1, $j, $output, $locale);
        }
        if($locale == 'ar') {
            return $this->result_ar;
        } elseif($locale == 'en') {
            return $this->result_en;
        }
    }

    private function handleModels($arr, $model) {
        $products = [];
        foreach ($arr as $row) {
            $products[] = [
                'category_id' => $model->category_id,
                'vendor_id' => $model->vendor_id,
                'name' => $row,
                'desc' => $this->handleDesc($model->desc),
                'short_desc' => $this->handleDesc($model->short_desc),
                'rate' => 5,
                'type' => 'product',
                'price' => 0,
                'cost' => 0,
                'stock' => 100,
                'SKU' => Str::sku('yt', '-'),
                'active' => 0,
                'slug' => Str::slug($row['en']),
                'sort' => 0
            ];
//            Product::create([
//
//            ]);
        }
        dd($products);
    }

    private function handleDesc($desc) {
        dd($desc->getTranslations());
        return str_replace('///1///', 'Mohamed', $desc);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Password::make('Password')->rules(REQUIRED_PASSWORD_NOT_CONFIRMED_VALIDATION),
        ];
    }
}
