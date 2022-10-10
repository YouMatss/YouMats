<?php

namespace App\Models;

use App\Helpers\Traits\UnicodeJsonColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Inquire extends Model implements HasMedia
{
    use SoftDeletes, HasFactory, InteractsWithMedia, UnicodeJsonColumn;

    protected $guarded = ['id'];

    public function registerMediaCollections(): void{
        $this->addMediaCollection(INQUIRE_PATH);
    }
}
