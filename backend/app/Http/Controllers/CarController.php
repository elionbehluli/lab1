<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Resources\CarResource;
use App\Http\Requests\Cars\CarStoreRequest;
use App\Http\Requests\Cars\CarUpdateRequest;

class CarController extends Controller
{
    // List all cars using the resource
    public function index()
    {
        $cars = Car::all();
        return CarResource::collection($cars);
    }

    public function store(CarStoreRequest $request)
    {
        $request->validated();

        // Create a new car
        $car = Car::create($request->all());

        // Return the new car as a resource
        return new CarResource($car);
    }

    public function show($id)
    {
        // Retrieve the car using the provided id
        $car = Car::findOrFail($id);

        // Return the specified car as a resource
        return new CarResource($car);
    }

    public function update(CarUpdateRequest $request, int $id)
    {
        // Find the car record using the provided ID
        $car = Car::findOrFail($id);

        $requestData = $request->all();

        // Check each field in the validated data
        foreach ($requestData as $key => $value) {
            // If the value is null, replace it with the existing value from $car
            if ($value === null || $value === '') {
                $requestData[$key] = $car->$key;
            }
        }

        // Update the car record using the merged data
        $car->update($requestData);

        // Return the updated car as a resource
        return new CarResource($car);
    }

    public function destroy($id): bool
    {
        $car = Car::findOrFail($id);

        return $car->delete();
    }
}
