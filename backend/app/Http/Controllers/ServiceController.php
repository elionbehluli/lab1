<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Resources\ServiceResource;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return ServiceResource::collection($services);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string', 
            'description' => 'required|string', 
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create a new car
        $service = Service::create($request->all());

        // Return the new car as a resource
        return new ServiceResource($service);
    } 

    public function show($id)
    {
        // Retrieve the car using the provided id
        $service = Service::findOrFail($id);

        // Return the specified car as a resource
        return new ServiceResource($service);
    }

    public function update(Request $request, int $id)
    {
       // Find the car record using the provided ID
        $service = Service::findOrFail($id);

        $requestData = $request->all();

        // Check each field in the validated data
        foreach ($requestData as $key => $value) {
            // If the value is null, replace it with the existing value from $car
            if ($value === null || $value === '') {
                $requestData[$key] = $service->$key;
            }
        }
        
        $validator = Validator::make($requestData, [
            'name' => 'sometimes|string', 
            'description' => 'sometimes|string', 
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        
        // Update the car record using the merged data
        $service->update([
            'name' => $requestData['name'], 
            'description' => $requestData['description'],
        ]);
                
        // Return the updated car as a resource
        return new ServiceResource($service);
    }

    public function destroy($id): bool
    {
        $service = Service::findOrFail($id);
       
        return $service->delete();
    }




}
