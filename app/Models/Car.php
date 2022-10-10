<?php

namespace App\Models;

use App\Helpers\Traits\DefaultImage;
use App\Helpers\Traits\UnicodeJsonColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Car extends Model implements HasMedia
{
    use SoftDeletes, HasFactory, HasTranslations, InteractsWithMedia, DefaultImage, UnicodeJsonColumn;

    protected $fillable = ['driver_id', 'type_id', 'name', 'model', 'license_no', 'max_load', 'price_per_kilo', 'active'];

    public $translatable = ['name'];

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('thumb')->width(200)->height(200);
        $this->addMediaConversion('cropper')->performOnCollections(CAR_PHOTO);
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection(CAR_PHOTO);
        $this->addMediaCollection(CAR_LICENSE);
    }

    public function driver() {
        return $this->belongsTo(Driver::class);
    }

    public function type() {
        return $this->belongsTo(CarType::class);
    }
}
