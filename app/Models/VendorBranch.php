<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class VendorBranch extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'website', 'fax', 'phone_number', 'latitude', 'longitude', 'address', 'vendor_id', 'city_id'];

    /**
     * @var string[]
     */
    protected $translatable = ['name'];


    /*
   Provide the Location value to the Nova field
   */
    public function getLocationAttribute()
    {
        return (object) [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }

    /*
    Transform the returned value from the Nova field
    */
    public function setLocationAttribute($value)
    {
        $latitude = round(object_get($value, 'latitude'), 7);
        $longitude = round(object_get($value, 'longitude'), 7);
        $this->attributes['latitude'] = $latitude;
        $this->attributes['longitude'] = $longitude;
    }

    /**
     * @return BelongsTo
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }
}
