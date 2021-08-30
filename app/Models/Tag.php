<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Tag extends Model {
    use SoftDeletes, HasFactory, HasTranslations;

    public $translatable = ['name', 'desc', 'meta_title', 'meta_desc', 'meta_keywords'];

    protected $appends = ['translated_name'];

    public function products() {
        return $this->belongsToMany(Product::class)->where('active', 1);
    }

    /**
     * @return mixed
     */
    public function getTranslatedNameAttribute() {
        return $this->getTranslations('name')[app()->getLocale()];
    }

}
