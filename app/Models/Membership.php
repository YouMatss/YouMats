<?php

namespace App\Models;

use App\Helpers\Traits\UnicodeJsonColumn;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Membership extends Model implements Sortable
{
    use SoftDeletes, HasFactory, SortableTrait, HasTranslations, CascadeSoftDeletes, UnicodeJsonColumn;

    public $translatable = ['name', 'desc'];

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['vendors'];
}
