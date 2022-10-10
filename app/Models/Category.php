<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use App\Helpers\Traits\UnicodeJsonColumn;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements Sortable, HasMedia
{
    use SoftDeletes, HasFactory, SortableTrait, HasTranslations, InteractsWithMedia, DefaultImage, CascadeSoftDeletes, NodeTrait, UnicodeJsonColumn;

    public $translatable = ['name', 'title', 'desc', 'short_desc', 'meta_title', 'meta_keywords', 'meta_desc'];

    protected $casts = [
        'template' => 'array'
    ];

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['products'];

    public function getNameAttribute() {
        if(!isset($this->getTranslations('name')[app()->getLocale()]))
            return;
        return $this->getTranslations('name')[app()->getLocale()];
    }

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('thumb')->width(200)->height(200);
        $this->addMediaConversion('cropper')->performOnCollections(CATEGORY_PATH, CATEGORY_COVER);
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection(CATEGORY_PATH)->singleFile();
        $this->addMediaCollection(CATEGORY_COVER)->singleFile();
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function allProducts() {
        return $this->hasMany(Product::class);
    }

    /**
     * @return HasMany|HasManyThrough
     */
    public function products()
    {
        if($this->isRoot()) {
            return $this->hasManyThrough(Product::class, self::class, 'parent_id')
                ->where('products.active', 1)->orderBy('products.updated_at', 'desc');
        }
        return $this->hasMany(Product::class)
            ->where('products.active', 1)
            ->orderBy('products.updated_at', 'desc');
    }

    /**
     * @return Builder
     */
    public function vendors(): Builder
    {
        return $this->belongsToMany(Vendor::class, Product::class)
            ->join('categories', 'categories.id', 'products.category_id')
            ->orWhere('categories.parent_id', $this->id)
            ->distinct()->get()->unique()->toQuery();
    }

    /**
     * @return mixed
     */
    public function subscribedVendors()
    {
        return Vendor::join('products', 'products.vendor_id', '=', 'vendors.id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('subscribes', function ($join) {
                $join->on('subscribes.category_id', '=', 'categories.id');
                $join->on('subscribes.vendor_id', '=', 'vendors.id');
            })
            ->where('categories.id', $this->id)
            ->whereDate('subscribes.expiry_date', '>', now())
            ->select('vendors.id', 'vendors.name', 'vendors.slug')
            ->distinct()->get();
    }

    /**
     * @return HasMany
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    /**
     * @return mixed
     */
    public function tags()
    {
        return Tag::select('tags.*')->join('product_tag AS pt', 'pt.tag_id', '=', 'tags.id')
            ->join('products as p', 'p.id', '=', 'pt.product_id')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->where('c.id', '=', $this->id)->distinct('tags.id')->get();
    }

    /**
     * @return BelongsToMany
     */
    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Membership::class, 'categories_memberships', 'category_id', 'membership_id');
    }
}
