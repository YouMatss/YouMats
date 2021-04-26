<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Driver\CarRequest;
use App\Http\Resources\CarResource;
use App\Http\Resources\CarTypeResource;
use App\Models\Car;
use App\Models\CarType;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index() {
        $driver = Auth::guard('driver-api')->user();
        $cars = $driver->cars;

        return CarResource::collection($cars);
    }

    public function store(CarRequest $request) {
        $data = $request->validated();
        $driver = Auth::guard('driver-api')->user();
        $data['driver_id'] = $driver->id;

        $car = Car::create($data);

        if(isset($request->car_photo))
            foreach($request->car_photo as $image) {
                $car->addMedia($image)->toMediaCollection(CAR_PHOTO);
            }

        if(isset($request->car_license))
            foreach($request->car_license as $image) {
                $car->addMedia($image)->toMediaCollection(CAR_LICENSE);
            }

        $car->setTranslation('name', 'en', $data['name_en']);
        $car->setTranslation('name', 'ar', $data['name_ar']);

        $car->save();

        return response()->json([
            'message' => 'Car Added Successfully.',
            'car' => new CarResource($car)
        ], 200);
    }

    public function update(CarRequest $request, $id) {
        $data = $request->validated();
        $car = Car::findorfail($id);

        if(isset($request->car_photo))
            foreach($request->car_photo as $image) {
                $car->addMedia($image)->toMediaCollection(CAR_PHOTO);
            }

        if(isset($request->car_license))
            foreach($request->car_license as $image) {
                $car->addMedia($image)->toMediaCollection(CAR_LICENSE);
            }

        $car->setTranslation('name', 'en', $data['name_en']);
        $car->setTranslation('name', 'ar', $data['name_ar']);

        $car->update($data);

        return response()->json([
            'message' => 'Car Updated Successfully.',
            'car' => new CarResource($car)
        ], 200);
    }

    public function delete($id) {
        $driver = Auth::guard('driver-api')->user();

        if($driver->cars()->where('id', $id)->first()) {
            Car::destroy($id);
        } else {
            return response()->json(['message' => 'This car doesn\'t exists!'], 400);
        }
        return response()->json(['message' => 'Car Deleted Successfully.'], 200);
    }

    public function getCarTypes() {
        return CarTypeResource::collection(CarType::all());
    }
}
