<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements Sortable, HasMedia
{
    use SoftDeletes, HasFactory, SortableTrait, HasTranslations, InteractsWithMedia, DefaultImage, CascadeSoftDeletes, NodeTrait;

    public $translatable = ['name', 'desc', 'short_desc', 'meta_title', 'meta_keywords', 'meta_desc'];

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['products'];

    public function getNameAttribute() {
        if(!isset($this->getTranslations('name')[app()->getLocale()]))
            return;
        return $this->getTranslations('name')[app()->getLocale()];
    }
    public function getMetaTitleAttribute() {
        if(!isset($this->getTranslations('meta_title')[app()->getLocale()]))
            return;
        if(empty($this->getTranslations('meta_title')[app()->getLocale()]))
            return $this->getTranslations('name')[app()->getLocale()];
        return $this->getTranslations('meta_title')[app()->getLocale()];
    }
    public function getMetaDescAttribute() {
        if(!isset($this->getTranslations('meta_desc')[app()->getLocale()]))
            return;
        if(empty($this->getTranslations('meta_desc')[app()->getLocale()]))
            return $this->getTranslations('short_desc')[app()->getLocale()];
        return $this->getTranslations('meta_desc')[app()->getLocale()];
    }
    public function getMetaKeywordsAttribute() {
        if(!isset($this->getTranslations('meta_keywords')[app()->getLocale()]))
            return;
        if(empty($this->getTranslations('meta_keywords')[app()->getLocale()]))
            return $this->getTranslations('name')[app()->getLocale()];
        return $this->getTranslations('meta_keywords')[app()->getLocale()];
    }

    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')
            ->width(200)->height(200);

        $this->addMediaConversion('cropper')
            ->performOnCollections(CATEGORY_PATH);

        $this->addMediaConversion('cropper')
            ->performOnCollections(CATEGORY_COVER);
    }

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function products() {
        if($this->isRoot()) {
            return $this->hasManyThrough(Product::class, self::class, 'parent_id')
                ->where('active', 1)->orderBy('updated_at', 'desc');
        }
        return $this->hasMany(Product::class)->where('active', 1)->orderBy('updated_at', 'desc');
    }

    public function vendors() {
        return $this->belongsToMany(Vendor::class, Product::class)->distinct();
    }

    /**
     * @return HasMany
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    public function tags() {
        return Tag::select('tags.*')->join('product_tag AS pt', 'pt.tag_id', '=', 'tags.id')
            ->join('products as p', 'p.id', '=', 'pt.product_id')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->where('c.id', '=', $this->id)->distinct()->get();
    }
}
