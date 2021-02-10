<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Currency extends Model implements Sortable, HasMedia
{
    use SoftDeletes, HasFactory, SortableTrait, InteractsWithMedia;

    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')
            ->width(50)->height(50);
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection(CURRENCY_PATH);
    }
}
