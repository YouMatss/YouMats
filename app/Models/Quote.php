<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes, HasFactory;

    public function items() {
        return $this->hasMany(QuoteItem::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
