<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use App\Helpers\Traits\UnicodeJsonColumn;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia, MustVerifyEmail {
    use HasApiTokens, SoftDeletes, HasFactory, Notifiable, InteractsWithMedia, DefaultImage, UnicodeJsonColumn;

//    protected $guarded = ['id'];
    protected $fillable = ['type', 'name', 'email', 'phone', 'phone2', 'email_verified_at', 'password', 'address', 'address2',
        'latitude', 'longitude', 'remember_token', 'active'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('size_height_200')
            ->height(200)
            ->performOnCollections(USER_PROFILE)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_30_30')
            ->crop(Manipulations::CROP_CENTER, 30, 30)
            ->performOnCollections(USER_PROFILE)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_50_50')
            ->crop(Manipulations::CROP_CENTER, 50, 50)
            ->performOnCollections(USER_PROFILE)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_200_200')
            ->crop(Manipulations::CROP_CENTER, 200, 200)
            ->performOnCollections(USER_PROFILE)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_height_300')
            ->height(300)
            ->performOnCollections(USER_COVER)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('size_1350_300')
            ->crop(Manipulations::CROP_CENTER, 1350, 300)
            ->performOnCollections(USER_COVER)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('cropper')
            ->performOnCollections(USER_PROFILE, USER_COVER)->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('licenses')
            ->performOnCollections(COMPANY_PATH)->format(Manipulations::FORMAT_WEBP);
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection(USER_PROFILE)->singleFile();
        $this->addMediaCollection(USER_COVER)->singleFile();
        $this->addMediaCollection(COMPANY_PATH);
    }

    public function orders() {
        return $this->hasMany(Order::class)->with('items')->orderBy('id', 'desc');
    }

    /**
     * @return HasMany
     */
    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class)->with('items')->orderBy('id', 'desc');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function vendors_conversations(): \Illuminate\Support\Collection
    {
        return ($this->belongsToMany(Vendor::class, 'user_messages',
            'sender_id','receiver_id')->where('sender_type', 'user')->get()->collect()->unique())
            ->merge($this->belongsToMany(Vendor::class, 'user_messages',
            'receiver_id','sender_id')->where('receiver_type', 'user')->get()->collect()->unique())
            ->unique('id');
    }

    /**
     * @param $vendor_id
     * @return \Illuminate\Support\Collection
     */
    private function messages($vendor_id): \Illuminate\Support\Collection
    {
        return ($this->hasMany(UserMessage::class, 'sender_id')
            ->with('message')->where([
                'receiver_id' => $vendor_id, 'receiver_type' => 'vendor', 'sender_type' => 'user'
            ])->get()->collect())
            ->merge($this->hasMany(UserMessage::class, 'receiver_id')
                ->with('message')->where([
                    'sender_id' => $vendor_id, 'receiver_type' => 'user', 'sender_type' => 'vendor'
                ])->get()->collect());
    }

    /**
     * @param $vendor_id
     * @return mixed
     */
    public function last_message($vendor_id) {
        return $this->messages($vendor_id)->sortBy('created_at')->last()->message;
    }

    /**
     * @param $vendor_id
     * @return int
     */
    public function count_messages($vendor_id): int
    {
        return count($this->messages($vendor_id));
    }

    /**
     * @return HasMany
     */
    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * @return mixed
     */
    public function rate() {
        return $this->trips()->avg('user_rate');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function reviews(): \Illuminate\Support\Collection
    {
        return $this->trips()->pluck('user_review');
    }

}
