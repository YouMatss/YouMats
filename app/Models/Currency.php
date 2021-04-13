<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Currency extends Model implements Sortable, HasMedia
{
    use SoftDeletes, HasFactory, SortableTrait, InteractsWithMedia, HasTranslations;

    public $translatable = ['symbol'];

    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')
            ->width(50)->height(50);
    }
}
