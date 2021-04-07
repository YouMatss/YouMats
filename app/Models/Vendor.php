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

    protected $fillable = ['name', 'country_id', 'email' , 'phone', 'phone2', 'address', 'address2', 'whatsapp_phone',
        'latitude', 'longitude', 'shipping_prices',
        'membership_id', 'password', 'facebook_url', 'twitter_url' ,'pinterest_url', 'instagram_url', 'youtube_url', 'website_url',
        'slug'];

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

    public function getPhoneAttribute($value) {
        return '+966' . trim($value, '+966');
    }
    public function getPhone2Attribute($value) {
        return '+966' . trim($value, '+966');
    }
    public function getWhatsappPhoneAttribute($value) {
        return '+966' . trim($value, '+966');
    }
    public function setPhoneAttribute($value) {
        $this->attributes['phone'] = '+966' . ltrim($value, '+966');
    }
    public function setPhone2Attribute($value) {
        $this->attributes['phone2'] = '+966' . ltrim($value, '+966');
    }
    public function setWhatsappPhoneAttribute($value) {
        $this->attributes['whatsapp_phone'] = '+966' . ltrim($value, '+966');
    }

    public function users_conversations() {
        return ($this->belongsToMany(User::class, 'user_messages',
            'sender_id','receiver_id')->where('sender_type', 'vendor')->get()->collect()->unique())
            ->merge($this->belongsToMany(User::class, 'user_messages',
                'receiver_id','sender_id')->where('receiver_type', 'vendor')->get()->collect()->unique())
            ->unique('id');
    }

    private function messages($user_id) {
        return ($this->hasMany(UserMessage::class, 'sender_id')
            ->with('message')->where([
                'receiver_id' => $user_id, 'receiver_type' => 'user', 'sender_type' => 'vendor'
            ])->get()->collect())
            ->merge($this->hasMany(UserMessage::class, 'receiver_id')
            ->with('message')->where([
                'sender_id' => $user_id, 'receiver_type' => 'vendor', 'sender_type' => 'user'
            ])->get()->collect());
    }

    public function last_message($user_id) {
        return $this->messages($user_id)->sortBy('created_at')->last()->message;
    }

    public function count_messages($user_id) {
        return count($this->messages($user_id));
    }

}
