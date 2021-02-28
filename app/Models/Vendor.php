<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vendor extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use SoftDeletes, HasFactory, Notifiable, InteractsWithMedia, DefaultImage;

    protected $fillable = ['name', 'city_id', 'email' , 'phone', 'phone2', 'address', 'address2', 'whatsapp_phone', 'membership_id', 'password', 'facebook_url', 'twitter_url' ,'pinterest_url', 'instagram_url', 'youtube_url', 'website_url'];

    protected $guard = 'vendor';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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

    public function city() {
        return $this->belongsTo(City::class);
    }

    /**
     * @return HasMany
     */
    public function branches(): HasMany
    {
        return $this->hasMany(VendorBranch::class);
    }

    /**
     * @return HasManyThrough
     */
    public function order_items(): HasManyThrough
    {
        return $this->hasManyThrough(OrderItem::class, Product::class, 'vendor_id', 'product_id');
    }

}
