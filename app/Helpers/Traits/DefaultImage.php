<?php

namespace App\Helpers\Traits;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait DefaultImage {

    protected static string $defaultImage = '/assets/img/default_logo.jpg';
    protected static string $defaultCover = '/assets/img/default_cover.jpg';

    public function getFirstMediaUrlOrDefault(string $collectionName = '', string $conversionName = '')
    {
        $locale = LaravelLocalization::getCurrentLocale();
        $url = $this->getFirstMediaUrl($collectionName, $conversionName);
        $image = '';

        if($collectionName == VENDOR_COVER || $collectionName == USER_COVER)
            $image = $this::$defaultCover;
        else
            $image = $this::$defaultImage;

        $collection = $this->getFirstMedia($collectionName);

        if($collection) {
            $title = json_decode($collection->img_title, true)[$locale] ?? $this->name;
            $alt = json_decode($collection->img_alt, true)[$locale] ?? $this->name;
        } else {
            $title = $this->name;
            $alt = $this->name;
        }

        return [
            'url' => strlen($url) > 1 ? $url : $image,
            'title' => $title,
            'alt' => $alt
        ];
    }
}
