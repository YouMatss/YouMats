<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Tag extends Model {
    use SoftDeletes, HasFactory, HasTranslations;

    public $translatable = ['name', 'desc', 'meta_title', 'meta_desc', 'meta_keywords'];

    public function products() {
        return $this->belongsToMany(Product::class);
    }

}
