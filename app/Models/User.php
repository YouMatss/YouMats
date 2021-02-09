<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia, MustVerifyEmail {
    use SoftDeletes, HasFactory, Notifiable, InteractsWithMedia;

//    protected $guarded = ['id'];
    protected $fillable = ['type', 'name', 'email', 'phone', 'phone2', 'email_verified_at', 'password', 'address', 'address2',
        'remember_token', 'active'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
