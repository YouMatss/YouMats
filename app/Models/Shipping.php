<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Shipping extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function bindings(): HasMany
    {
        return $this->hasMany(ShippingBinding::class);
    }
}
