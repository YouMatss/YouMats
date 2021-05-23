<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
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
            'country' => new CountryResource($this->country),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'phone2' => $this->phone2,
            'driver_photo' => $this->getImages(DRIVER_PHOTO),
            'driver_id' => $this->getImages(DRIVER_ID),
            'driver_license' => $this->getImages(DRIVER_LICENSE),
        ];
    }

    public function getImages($path) {
        $images = [];
        foreach ($this->getMedia($path) as $image) {
            $images[] = $image->getFullUrl();
        }
        return $images;
    }
}
