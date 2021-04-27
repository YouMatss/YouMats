<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\MakeRequestRequest;
use App\Http\Resources\TripResource;
use App\Models\Car;
use App\Models\Driver;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function makeRequest(MakeRequestRequest $request) {
        $data = $request->validated();
        $user = Auth::guard('api')->user();

        $distance = haversineGreatCircleDistance($data['pickup_latitude'], $data['pickup_longitude'], $data['destination_latitude'], $data['destination_longitude']);
        $cars = Car::where('active', 1)->where('type_id', $data['car_type_id'])->get();

        foreach ($cars as $car) {
            $car->estmitedPrice = $car->price_per_kilo * $distance;
            $avgPrice[] = $car->estmitedPrice;
        }
        $trip = Trip::create([
            'user_id' => $user->id,
            'pickup_latitude' => $data['pickup_latitude'],
            'pickup_longitude' => $data['pickup_longitude'],
            'destination_latitude' => $data['destination_latitude'],
            'destination_longitude' => $data['destination_longitude'],
            'distance' => $distance,
            'price' => array_sum($avgPrice) / count($avgPrice),
            'driver_available' => count($cars)
        ]);

        return new TripResource($trip);
    }
}
