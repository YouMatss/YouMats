<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia, MustVerifyEmail {
    use HasApiTokens, SoftDeletes, HasFactory, Notifiable, InteractsWithMedia, DefaultImage;

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

    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')
            ->width(200)->height(200);

        $this->addMediaConversion('cropper')
            ->performOnCollections(USER_PROFILE);

        $this->addMediaConversion('cropper')
            ->performOnCollections(USER_COVER);
    }

    public function orders() {
        return $this->hasMany(Order::class)->with('items');
    }

    /**
     * @return HasMany
     */
    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class)->with('items');
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

}
