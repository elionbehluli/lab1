<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceHistory;
use App\Models\Car;
use App\Http\Resources\ServiceHistoryResource;
use Illuminate\Support\Facades\Validator;

class ServiceHistoriesController extends Controller
{
    public function index()
    {
        $serviceHistories = ServiceHistory::all();

        return ServiceHistoryResource::collection($serviceHistories);
    }

    public function specificCarSerciveHistory($id)
    {
        $car = Car::findOrFail($id);
        
        $serviceHistories = $car->serviceHistories;

        return ServiceHistoryResource::collection($serviceHistories);
    }

    public function show($id)
    {
        // Retrieve the car using the provided id
        $service = ServiceHistory::findOrFail($id);

        // Return the specified car as a resource
        return new ServiceHistoryResource($service);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|int',
            'service_id' => 'required|int',
            'mileage_at_service' => 'required|int',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        // Create a new car
        $serviceHistory = ServiceHistory::create($request->all());

        // Return the new car as a resource
        return new ServiceHistoryResource($serviceHistory);
    }

    public function destroy($id): bool
    {
        $serviceHistory = ServiceHistory::findOrFail($id);
       
        return $serviceHistory->delete();
    }
}