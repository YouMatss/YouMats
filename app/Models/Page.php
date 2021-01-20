<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Page extends Model implements Sortable, HasMedia
{
    use SoftDeletes, HasFactory, Loggable, SortableTrait, HasTranslations, InteractsWithMedia;

    public $translatable = ['title', 'desc', 'short_desc', 'meta_title', 'meta_keywords', 'meta_desc'];

    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')
            ->width(200)->height(200);

        $this->addMediaConversion('cropper');
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection(PAGE_PATH);
    }
}
