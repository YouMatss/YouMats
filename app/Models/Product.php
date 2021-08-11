<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Znck\Eloquent\Traits\BelongsToThrough;

class Product extends Model implements Sortable, HasMedia, Buyable
{
    use SoftDeletes, HasFactory, SortableTrait, HasTranslations, InteractsWithMedia, DefaultImage, BelongsToThrough;

    public $translatable = ['name', 'desc', 'short_desc', 'meta_title', 'meta_keywords', 'meta_desc'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url', 'delivery'];

    public function getMetaTitleAttribute() {
        if(!isset($this->getTranslations('meta_title')[app()->getLocale()]))
            return;
        if(empty($this->getTranslations('meta_title')[app()->getLocale()]))
            return $this->getTranslations('name')[app()->getLocale()];
        return $this->getTranslations('meta_title')[app()->getLocale()];
    }
    public function getMetaDescAttribute() {
        if(!isset($this->getTranslations('meta_desc')[app()->getLocale()]))
            return;
        if(empty($this->getTranslations('meta_desc')[app()->getLocale()]))
            return $this->getTranslations('short_desc')[app()->getLocale()];
        return $this->getTranslations('meta_desc')[app()->getLocale()];
    }
    public function getMetaKeywordsAttribute() {
        if(!isset($this->getTranslations('meta_keywords')[app()->getLocale()]))
            return;
        if(empty($this->getTranslations('meta_keywords')[app()->getLocale()]))
            return $this->getTranslations('name')[app()->getLocale()];
        return $this->getTranslations('meta_keywords')[app()->getLocale()];
    }

    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')
            ->width(200)->height(200);

        $this->addMediaConversion('cropper')
            ->performOnCollections(PRODUCT_PATH);
    }

    public function getPriceAttribute($value) {
        return round($value * getCurrency('rate'), 2);
    }

    public function getCostAttribute($value) {
        return round($value * getCurrency('rate'), 2);
    }

    public function getLocationAttribute() {
        return $this->vendor->select('latitude', 'longitude')->first();
    }

    public function getDeliveryAttribute() {
        if(isset($this->shipping)) {
            return $this->shipping;
        } elseif(isset($this->category->shipping)) {
            return  $this->category->shipping;
        } else {
            return null;
        }
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipping(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }

    /**
     * @param null $options
     * @return int|mixed|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    /**
     * @param null $options
     * @return string
     */
    public function getBuyableDescription($options = null): string
    {
        return $this->name;
    }

    /**
     * @param null $options
     * @return float
     */
    public function getBuyablePrice($options = null): float
    {
        return $this->price;
    }

    /**
     * @param $value
     * @return array
     */
    public function getImageUrlAttribute($value): array
    {
        return $this->getFirstMediaUrlOrDefault(PRODUCT_PATH);
    }

    /**
     * @param $query
     * @param $price
     * @return mixed
     */
    public function scopePriceFrom($query, $price)
    {
        return $query->where('price', '>=', $price);
    }

    /**
     * @param $query
     * @param $price
     * @return mixed
     */
    public function scopePriceTo($query, $price)
    {
        return $query->where('price', '<=', $price);
    }
}
