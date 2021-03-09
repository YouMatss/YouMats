<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Country extends Model implements Sortable
{
    use SoftDeletes, HasFactory, SortableTrait, HasTranslations, CascadeSoftDeletes;

    public $translatable = ['name'];

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['cities'];

    public function cities() {
        return $this->hasMany(City::class);
    }

    public function vendors() {
        return $this->hasMany(Vendor::class);
    }
}
