<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use App\Helpers\Traits\UnicodeJsonColumn;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Znck\Eloquent\Traits\BelongsToThrough;

class Vendor extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use SoftDeletes, HasFactory, Notifiable, InteractsWithMedia, DefaultImage, HasTranslations, CascadeSoftDeletes, BelongsToThrough, UnicodeJsonColumn;

    protected $fillable = ['name', 'country_id', 'subCategory_id', 'email' , 'contacts', 'address', 'type', 'latitude', 'longitude',
        'password', 'facebook_url', 'twitter_url' ,'pinterest_url', 'instagram_url', 'youtube_url', 'website_url', 'slug', 'active'];

    protected $guard = 'vendor';

    protected $translatable = ['name', 'meta_title', 'meta_keywords', 'meta_desc'];

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['products', 'branches'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'contacts'          => 'array',
        'location'          => 'array'
    ];

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('size_height_50')
            ->height(50)
            ->nonQueued()
            ->performOnCollections(VENDOR_LOGO)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_262_50')
            ->crop(Manipulations::CROP_CENTER, 262, 50)
            ->nonQueued()
            ->performOnCollections(VENDOR_LOGO)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_30_30')
            ->crop(Manipulations::CROP_CENTER, 30, 30)
            ->nonQueued()
            ->performOnCollections(VENDOR_LOGO)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_50_50')
            ->crop(Manipulations::CROP_CENTER, 50, 50)
            ->nonQueued()
            ->performOnCollections(VENDOR_LOGO)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_height_100')
            ->height(100)
            ->nonQueued()
            ->performOnCollections(VENDOR_LOGO)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_100_100')
            ->crop(Manipulations::CROP_CENTER, 100, 100)
            ->nonQueued()
            ->performOnCollections(VENDOR_LOGO)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_height_150')
            ->height(150)
            ->nonQueued()
            ->performOnCollections(VENDOR_LOGO)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_150_150')
            ->crop(Manipulations::CROP_CENTER, 150, 150)
            ->nonQueued()
            ->performOnCollections(VENDOR_LOGO)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_height_200')
            ->height(200)
            ->nonQueued()
            ->performOnCollections(VENDOR_LOGO)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_200_200')
            ->crop(Manipulations::CROP_CENTER, 200, 200)
            ->nonQueued()
            ->performOnCollections(VENDOR_LOGO)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_height_300')
            ->height(300)
            ->nonQueued()
            ->performOnCollections(VENDOR_COVER)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_1350_300')
            ->crop(Manipulations::CROP_CENTER, 1350, 300)
            ->nonQueued()
            ->performOnCollections(VENDOR_COVER)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('cropper')
            ->nonQueued()
            ->performOnCollections(VENDOR_LOGO, VENDOR_COVER)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('licenses')
            ->nonQueued()
            ->performOnCollections(VENDOR_PATH)->format(Manipulations::FORMAT_WEBP);
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection(VENDOR_LOGO)->singleFile();
        $this->addMediaCollection(VENDOR_COVER)->singleFile();
        $this->addMediaCollection(VENDOR_PATH);
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

    public function subscribes() {
        return $this->hasMany(Subscribe::class)->orderByDesc('expiry_date');
    }

    public function current_subscribes() {
        return $this->hasMany(Subscribe::class)->whereDate('expiry_date', '>=', now());
    }

    public function getSubscribeAttribute() {
        if(count($this->current_subscribes)) {
            return 1;
        }
        return 0;
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
    public function shippings(): HasMany
    {
        return $this->hasMany(Shipping::class);
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
        return $this->hasMany(OrderItem::class)->orderBy('id', 'desc');
    }

    /**
     * @return HasMany
     */
    public function quote_items(): HasMany
    {
        return $this->hasMany(QuoteItem::class)->orderBy('id', 'desc');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function users_conversations() {
        return ($this->belongsToMany(User::class, 'user_messages',
            'sender_id','receiver_id')->where('sender_type', 'vendor')->get()->collect()->unique())
            ->merge($this->belongsToMany(User::class, 'user_messages',
                'receiver_id','sender_id')->where('receiver_type', 'vendor')->get()->collect()->unique())
            ->unique('id');
    }

    /**
     * @param $user_id
     * @return \Illuminate\Support\Collection
     */
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

    /**
     * @param $user_id
     * @return mixed
     */
    public function last_message($user_id) {
        return $this->messages($user_id)->sortBy('created_at')->last()->message;
    }

    /**
     * @param $user_id
     * @return int
     */
    public function count_messages($user_id) {
        return count($this->messages($user_id));
    }

}
