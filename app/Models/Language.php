<?php

namespace App\Models;

use App\Helpers\Traits\UnicodeJsonColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Language extends Model implements Sortable, HasMedia
{
    use SoftDeletes, HasFactory, SortableTrait, HasTranslations, InteractsWithMedia, UnicodeJsonColumn;

    public $translatable = ['name'];

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('thumb')->width(50)->height(50);
        $this->addMediaConversion('cropper')->performOnCollections(LANGUAGE_PATH);
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection(LANGUAGE_PATH)->singleFile();
    }
}
