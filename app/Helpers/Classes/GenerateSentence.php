<?php


namespace App\Helpers\Classes;


use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class GenerateSentence
{
    private $result_ar;
    private $result_en;
    private $locales;

    public function __construct()
    {
        $this->locales = LaravelLocalization::getSupportedLanguagesKeys();
        $this->result_ar = [];
        $this->result_en = [];
    }

    public function printf($arr, $trim = false) {
        $output = [];
        $result = [];

        foreach ($this->locales as $locale) {
            for ($i = 0; $i < $arr['maxLength']; $i++) {
                if ($arr['data'][$locale][0][$i] != '')
                    $result[$locale] = $this->printUntil($arr['data'][$locale], count($arr['data'][$locale]), $arr['maxLength'], 0, $i, $output, $locale, $trim);
            }
        }

        return $result;
    }

    public function printUntil($template, $templateLength, $maxLength, $m, $n, $output, $locale, $trim) {
        $string = '';
        $output[$m] = $template[$m][$n];

        if ($m == $templateLength - 1) {
            for ($i = 0; $i < $templateLength; $i++) {
                if($templateLength - $i == 1 || $trim)
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
                $this->printUntil($template, $templateLength, $maxLength, $m+1, $j, $output, $locale, $trim);
        }
        if($locale == 'ar') {
            return $this->result_ar;
        } elseif($locale == 'en') {
            return $this->result_en;
        }
    }
}
