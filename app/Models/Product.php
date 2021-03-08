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

class Product extends Model implements Sortable, HasMedia, Buyable
{
    use SoftDeletes, HasFactory, SortableTrait, HasTranslations, InteractsWithMedia, DefaultImage;

    public $translatable = ['name', 'desc', 'short_desc', 'meta_title', 'meta_keywords', 'meta_desc'];

    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')
            ->width(200)->height(200);

        $this->addMediaConversion('cropper');
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection(PRODUCT_PATH);
    }

    public function getPriceAttribute($value) {
        return round($value * getCurrency('rate'), 2);
    }

    public function getCostAttribute($value) {
        return round($value * getCurrency('rate'), 2);
    }

    public function category() {
        return $this->hasOneThrough(Category::class, SubCategory::class, 'category_id', 'id');
    }

    public function subCategory() {
        return $this->belongsTo(SubCategory::class, 'subCategory_id');
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

}
