<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vendor extends Authenticatable implements HasMedia
{
    use SoftDeletes, HasFactory, Notifiable, Loggable, InteractsWithMedia;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function products() {
        return $this->hasMany(Product::class);
    }

    public function membership() {
        return $this->belongsTo(Membership::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

}
