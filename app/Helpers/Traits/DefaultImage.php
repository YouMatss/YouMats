<?php


namespace App\Helpers\Traits;

trait DefaultImage
{
    protected static string $defaultImage = '/assets/img/default_logo.jpg';
    protected static string $defaultCover = '/assets/img/default_cover.jpg';

    public function getFirstMediaUrlOrDefault(string $collectionName = '', string $conversionName = '')
    {
        $url = $this->getFirstMediaUrl($collectionName, $conversionName);
        $image = '';

        if($collectionName == VENDOR_COVER || $collectionName == USER_COVER)
            $image = $this::$defaultCover;
        else
            $image = $this::$defaultImage;

        return [
            'url' => strlen($url) > 1 ? $url : $image,
            'title' => $this->getFirstMediaUrl($collectionName, $conversionName)->img_title ?? $this->name, //Default image
            'alt' => $this->getFirstMediaUrl($collectionName, $conversionName)->img_alt ?? $this->name // Default alt
        ];
    }
}
