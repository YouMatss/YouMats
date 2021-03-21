<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Vendor extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use SoftDeletes, HasFactory, Notifiable, InteractsWithMedia, DefaultImage, HasTranslations, CascadeSoftDeletes;

    protected $fillable = ['name', 'city_id', 'email' , 'phone', 'phone2', 'address', 'address2', 'whatsapp_phone', 'membership_id', 'password', 'facebook_url', 'twitter_url' ,'pinterest_url', 'instagram_url', 'youtube_url', 'website_url'];

    protected $guard = 'vendor';

    protected $translatable = ['name'];

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['products', 'branches'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'shipping_prices' => 'array'
    ];

    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')
            ->width(200)->height(200);

        $this->addMediaConversion('cropper')
            ->performOnCollections(VENDOR_COVER);

        $this->addMediaConversion('cropper')
            ->performOnCollections(VENDOR_LOGO);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, 'vendor.password.reset', 'vendors'));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification('vendor.verification.verify'));
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function membership() {
        return $this->belongsTo(Membership::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function cities() {
        return $this->hasManyThrough(City::class, Country::class, 'id', 'country_id',
            'country_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function branches(): HasMany
    {
        return $this->hasMany(VendorBranch::class)->with('city');
    }

    /**
     * @return HasMany
     */
    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

}
