<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
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

    protected $guarded = ['id'];

    public $translatable = ['name', 'desc', 'short_desc', 'meta_title', 'meta_keywords', 'meta_desc'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url', 'delivery', 'contacts'];

    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')->width(200)->height(200);
        $this->addMediaConversion('cropper')->performOnCollections(PRODUCT_PATH);
    }

    public function getPriceAttribute($value) {
        return round($value * getCurrency('rate'), 2);
    }

    public function getFormattedPriceAttribute() {
        return number_format($this->price, 2);
    }

    public function getCostAttribute($value) {
        return round($value * getCurrency('rate'), 2);
    }

    public function getLocationAttribute() {
        return $this->vendor->select('latitude', 'longitude')->first();
    }

    /**
     * @return array|mixed|null
     */
    public function getDeliveryAttribute() {
        if($this->specific_shipping) {
            if($this->shipping_prices) {
                foreach (json_decode($this->shipping_prices, true) as $shipping) {
                    if(Session::has('city') && $shipping['cities'] == Session::get('city')) {
                        return $shipping;
                    }
                }
            }
            if(isset($this->default_price) && isset($this->default_time) && isset($this->default_format)) {
                return [
                    'price' => $this->default_price,
                    'time' => $this->default_time,
                    'format' => $this->default_format,
                ];
            }
        }
        if (isset($this->shipping)) {
            if($this->shipping->cities_prices) {
                foreach ($this->shipping->cities_prices as $shipping) {
                    if(Session::has('city') && $shipping['cities'] == Session::get('city')) {
                        return $shipping;
                    }
                }
            }
            if($this->shipping->default_price && $this->shipping->default_time && $this->shipping->default_format) {
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
     * @return string|null
     */
    public function delivery_cities() {
        $cities = [];
        if($this->specific_shipping) {
            if($this->shipping_prices) {
                foreach (json_decode($this->shipping_prices, true) as $shipping) {
                    $cities[] = $shipping['cities'];
                }
            }
            if(isset($this->default_price) && isset($this->default_time) && isset($this->default_format)) {
                return 'all';
            }
        }
        if (isset($this->shipping)) {
            if($this->shipping->cities_prices) {
                foreach ($this->shipping->cities_prices as $shipping) {
                    $cities[] = $shipping['cities'];
                }
            }
            if($this->shipping->default_price && $this->shipping->default_time && $this->shipping->default_format) {
                return 'all';
            }
        }
        if(count($cities))
            return City::whereIn('id', $cities)->get();
        return null;
    }

    public function getContactsAttribute() {
        try {
            if(isset($this->vendor->contacts)) {
                foreach ($this->vendor->contacts as $contact) {
                    if($contact['with'] != 'company' && Session::has('city') && isset($contact['cities'])) {
                        foreach ($contact['cities'] as $city) {
                            if($city == Session::get('city')) {
                                return 1;
                            }
                        }
                    }
                }
                return 0;
            }
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function phone() {
        if(isset($this->vendor->contacts[0]['phone']))
            return $this->vendor->contacts[0]['phone'];
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
    public function scopePrice($query, $price)
    {
        $prices = explode(';', $price);
        return $query->where('price', '>=', $prices[0])
                    ->where('price', '<=', $prices[1]);
    }
}
