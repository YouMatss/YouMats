<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class SubCategory extends Model implements Sortable, HasMedia
{
    use SoftDeletes, HasFactory, SortableTrait, HasTranslations, InteractsWithMedia, DefaultImage, CascadeSoftDeletes;

    public $translatable = ['name', 'desc', 'short_desc', 'meta_title', 'meta_keywords', 'meta_desc'];

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['products'];

    public function getNameAttribute() {
        return $this->getTranslations('name')[app()->getLocale()];
    }

    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')
            ->width(200)->height(200);

        $this->addMediaConversion('cropper')
            ->performOnCollections(SUB_CATEGORY_PATH);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function products() {
        return $this->hasMany(Product::class, 'subCategory_id')
            ->where('active', 1);
    }

    public function tags() {
        return Tag::select('tags.*')->join('product_tag AS pt', 'pt.tag_id', '=', 'tags.id')
            ->join('products as p', 'p.id', '=', 'pt.product_id')
            ->join('sub_categories as sub', 'sub.id', '=', 'p.subCategory_id')
            ->where('sub.id', '=', $this->id)->distinct()->get();
    }

    public function vendors() {
        return $this->hasMany(Vendor::class, 'subCategory_id');
    }

    public function attributes() {
        return $this->hasMany(Attribute::class, 'subCategory_id');
    }
}
