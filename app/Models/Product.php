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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model implements Sortable, HasMedia, Buyable
{
    use SoftDeletes, HasFactory, SortableTrait, HasTranslations, InteractsWithMedia, DefaultImage, BelongsToThrough;

    public $translatable = ['name', 'desc', 'short_desc', 'meta_title', 'meta_keywords', 'meta_desc'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

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
        $this->addMediaConversion('thumb')->width(200)->height(200);
        $this->addMediaConversion('cropper')->performOnCollections(PRODUCT_PATH);
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

    public function delivery($current_city = null) {
        if($this->specific_shipping) {
            if($this->shipping_prices) {
                foreach (json_decode($this->shipping_prices, true) as $shipping) {
                    if($shipping['cities'] == $current_city) {
                        return $shipping;
                    }
                }
            }
        }
        if (isset($this->shipping)) {
            if($this->shipping->cities_prices) {
                foreach ($this->shipping->cities_prices as $shipping) {
                    if($shipping['cities'] == $current_city) {
                        return $shipping;
                    }
                }
            }
            if($this->shipping->default_price) {
                return [
                    'price' => $this->shipping->default_price,
                    'time' => $this->shipping->default_time,
                    'format' => $this->shipping->default_format,
                ];
            }
        }
        return null;
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return BelongsTo
     */
    public function shipping(): BelongsTo
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
