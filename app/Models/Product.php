<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements Sortable
{
    use SoftDeletes, HasFactory, Loggable, SortableTrait, HasTranslations;

    public $translatable = ['name', 'desc', 'meta_title', 'meta_keywords', 'meta_desc'];

    public function category() {
        return $this->belongsTo(Category::class, SubCategory::class, '', 'subCategory_id');
    }

    public function subCategory() {
        return $this->belongsTo(SubCategory::class, 'subCategory_id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

}
