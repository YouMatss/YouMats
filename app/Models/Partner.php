<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Partner extends Model implements HasMedia
{
    use SoftDeletes, HasFactory, InteractsWithMedia, DefaultImage, HasTranslations;

    protected $translatable = ['name'];

    public function registerMediaCollections(): void {
        $this->addMediaCollection(PARTNER_PATH)->singleFile();
    }

    public function registerAllMediaConversions(): void {
        $this->addMediaConversion('thumb')->width(200)->height(200);
        $this->addMediaConversion('cropper')->performOnCollections(PARTNER_PATH);
    }

}
