<?php

namespace App\Models;

use App\Helpers\Classes\Shipping as ShippingHelper;
use App\Helpers\Traits\DefaultImage;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Znck\Eloquent\Traits\BelongsToThrough;

class Product extends Model implements Sortable, HasMedia, Buyable
{
    use SoftDeletes, HasFactory, SortableTrait, HasTranslations, InteractsWithMedia, DefaultImage, BelongsToThrough;

    protected $guarded = ['id'];

    public $translatable = ['name', 'temp_name', 'desc', 'short_desc', 'search_keywords', 'meta_title', 'meta_keywords', 'meta_desc'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url', 'delivery', 'contacts'];

    protected $casts = [
        'shipping_prices' => 'array'
    ];

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
     * @return array|null
     */
    public function getDeliveryAttribute() {
        try {
            $remap_shipping = [];
            if($this->specific_shipping && $this->shipping_prices) {
                $remap_shipping = ShippingHelper::remap($this->shipping_prices, false);
            } elseif(isset($this->shipping) && $this->shipping->prices) {
                $remap_shipping = ShippingHelper::remap($this->shipping->prices);
            }
            foreach ($remap_shipping as $city => $shipping) {
                if(Session::has('city') && $city == Session::get('city')) {
                    return ShippingHelper::result(ShippingHelper::getBestPrice($shipping, $this->min_quantity ?? 1));
                }
            }
            return null;
        } catch (\Exception $e) {}
    }

    /**
     * @return string|null
     */
    public function delivery_cities() {
        try {
            $cities = [];
            if ($this->specific_shipping) {
                if ($this->shipping_prices) {
                    foreach ($this->shipping_prices as $shipping) {
                        foreach ($shipping['attributes']['cities'] as $city) {
                            $cities[] = $city['city'];
                        }
                    }
                }
            } elseif (isset($this->shipping)) {
                if ($this->shipping->prices) {
                    foreach ($this->shipping->prices as $shipping) {
                        foreach ($shipping['attributes']['cities'] as $city) {
                            $cities[] = $city['attributes']['city'];
                        }
                    }
                }
            }
            if (count($cities))
                return City::whereIn('id', array_unique($cities))->get();
            return null;
        } catch (\Exception $e) {}
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

    /**
     * @return int
     */
    public function getSubscribeAttribute() {
        if($this->vendor->current_subscribe) {
            return 1;
        }
        return 0;
    }

    public function phone() {
        if(isset($this->vendor->contacts[0]['phone']))
            return $this->vendor->contacts[0]['phone'];
        return null;
    }

    public function phone_code() {
        if(isset($this->vendor->contacts[0]['phone_code']))
            return $this->vendor->contacts[0]['phone_code'];
        return null;
    }

    public function whatsapp_message() {
        $link = route('front.product', [generatedNestedSlug($this->category->ancestors()->pluck('slug')->toArray(), $this->category->slug), $this->slug]);
        $phone_code = ';;' . $this->phone_code() . ';;';
        return $link . '%0A%0A' . $phone_code;
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
