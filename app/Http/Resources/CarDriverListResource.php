<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarDriverListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'driver' => [
                'name' => $this->driver->name,
                'phone' => $this->phone,
                'phone2' => $this->phone2,
                'driver_photo' => $this->getFirstMediaUrl(DRIVER_PHOTO),
            ],
            'type' => $this->type->name,
            'model' => $this->model,
            'license_no' => $this->license_no,
            'car_photo' => $this->getFirstMediaUrl(CAR_PHOTO),
        ];
    }
}
