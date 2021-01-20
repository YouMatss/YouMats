<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Country extends Model implements Sortable
{
    use SoftDeletes, HasFactory, Loggable, SortableTrait, HasTranslations;

    public $translatable = ['name'];

    public function cities() {
        return $this->hasMany(City::class);
    }
}
