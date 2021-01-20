<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use SoftDeletes, HasFactory, Loggable, HasTranslations;

    public $translatable = ['name'];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function vendors() {
        return $this->hasMany(Vendor::class);
    }
}
