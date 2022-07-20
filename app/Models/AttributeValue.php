<?php

namespace App\Models;

use App\Helpers\Traits\UnicodeJsonColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AttributeValue extends Model
{
    use HasFactory, HasTranslations, UnicodeJsonColumn;

    public $translatable = ['value'];

    public function attribute() {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
