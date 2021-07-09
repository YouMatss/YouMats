<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Driver extends Authenticatable implements HasMedia
{
    use HasApiTokens, SoftDeletes, HasFactory, Notifiable, InteractsWithMedia, DefaultImage;

    protected $fillable = ['country_id', 'name', 'email', 'phone', 'phone2', 'whatsapp', 'email_verified_at', 'password', 'remember_token', 'active'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')
            ->width(200)->height(200);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function car(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Car::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trips(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * @return mixed
     */
    public function rate() {
        return $this->trips()->avg('driver_rate');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function reviews(): \Illuminate\Support\Collection
    {
        return $this->trips()->pluck('driver_review');
    }
}
