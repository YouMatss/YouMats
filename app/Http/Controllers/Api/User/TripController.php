<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\MakeRequestRequest;
use App\Http\Requests\Api\User\PickDriverRequest;
use App\Http\Resources\CarDriverListResource;
use App\Http\Resources\TripResource;
use App\Models\Car;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function makeRequest(MakeRequestRequest $request) {
        $data = $request->validated();
        $user_id = Auth::guard('api')->id();

        $distance = haversineGreatCircleDistance($data['pickup_latitude'], $data['pickup_longitude'], $data['destination_latitude'], $data['destination_longitude']);
        $cars = Car::where('active', 1)->where('type_id', $data['car_type_id'])->get();

        if(!count($cars)) {
            return response()->json(['message' => 'Not available cars now!'], 400);
        }

        foreach ($cars as $car) {
            $avgPrice[] = $car->price_per_kilo * $distance;
        }
        $trip = Trip::create([
            'user_id' => $user_id,
            'pickup_latitude' => $data['pickup_latitude'],
            'pickup_longitude' => $data['pickup_longitude'],
            'destination_latitude' => $data['destination_latitude'],
            'destination_longitude' => $data['destination_longitude'],
            'distance' => $distance,
            'driver_status' => '0',
            'status' => '0'
        ]);

        return (new TripResource($trip))->additional([
            'available_cars' => CarDriverListResource::collection($cars),
            'estimated_price' => array_sum($avgPrice) / count($avgPrice),
            'cars_available' => count($cars)
        ]);
    }

    public function pickDriver(PickDriverRequest $request) {
        $data = $request->validated();
        $user_id = Auth::guard('api')->id();

        $trip = Trip::where([
            'id' => $data['trip_id'],
            'user_id' => $user_id
        ])->first();

        $trip->update([
            'car_id' => $data['car_id']
        ]);

        return new TripResource($trip);
    }
}
