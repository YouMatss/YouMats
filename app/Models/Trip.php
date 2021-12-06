<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['started_at'];

    public function getPickupLocationAttribute() {
        return (object) [
            'pickup_latitude' => $this->pickup_latitude,
            'pickup_longitude' => $this->pickup_longitude
        ];
    }
    public function setPickupLocationAttribute($value) {
        $pickup_latitude = round(object_get($value, 'pickup_latitude'), 7);
        $pickup_longitude = round(object_get($value, 'pickup_longitude'), 7);
        $this->attributes['pickup_latitude'] = $pickup_latitude;
        $this->attributes['pickup_longitude'] = $pickup_longitude;
    }

    public function getDestinationLocationAttribute() {
        return (object) [
            'destination_latitude' => $this->destination_latitude,
            'destination_longitude' => $this->destination_longitude
        ];
    }
    public function setDestinationLocationAttribute($value) {
        $destination_latitude = round(object_get($value, 'destination_latitude'), 7);
        $destination_longitude = round(object_get($value, 'destination_longitude'), 7);
        $this->attributes['destination_latitude'] = $destination_latitude;
        $this->attributes['destination_longitude'] = $destination_longitude;
    }


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function driver() {
        return $this->belongsTo(Driver::class);
    }
}
