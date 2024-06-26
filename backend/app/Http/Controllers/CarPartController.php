<?php

namespace App\Http\Controllers;

use App\Models\CarPart;
use Illuminate\Http\Request;
use App\Http\Resources\CarPartResource;
use App\Http\Requests\Cars\CarStoreRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Car;

class CarPartController extends Controller
{
    public function index()
    {
        $carparts = CarPart::all();
        return CarPartResource::collection($carparts);
    }

    public function specificCarParts($id)
    {
        $car = Car::findOrFail($id);
        
        $carParts = $car->carParts;

        return CarPartResource::collection($carParts);
    }    

    public function show($id)
    {
        // Retrieve the car using the provided id
        $carPart = CarPart::findOrFail($id);

        return new CarPartResource($carPart);

    }

    public function addCarPartsToCar(Request $request, int $id)
    {
        $carPart = CarPart::findOrFail($id);

        // Validate the request
        $validatedData = $request->validate([
            'car_id' => 'required|int'
        ]);

        // Update the user's role
        $carPart->car_id = $validatedData['car_id'];

        if ($carPart->save()) {
            return response()->json(['success' => 'Car part added to car.'], 200);
        } else {
            return response()->json(['error' => 'Failed to add car part.'], 500);
        }
    }

   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string', 
            'description' => 'required|string', 
            'price' => 'required|string',
            'year_of_production' => 'required|string',
            'image_url' => 'file|image|max:10240',
            'brand_id' => 'sometimes|exists:brands,id',
            'car_id' => 'sometimes|exists:cars,id'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $logoFile = $request->file('image_url');
        if($logoFile){
            $logoPath = $logoFile->store('carpart_logos', 'public');
        }
        else{
            $logoPath = null;
        }

        // Create a new car part
        $carparts = CarPart::create([
            'name' => $request->name, 
            'description' => $request->description,
            'price' => $request->price, 
            'year_of_production' => $request->year_of_production,
            'brand_id' => $request->brand_id,
            'car_ide'=> $request->car_id,
            'image_url' => $logoPath 

        ]);

        return $carparts;
    }

    public function update(Request $request, int $id)
    {
        // Find the car part record using the provided ID
        $carparts = CarPart::findOrFail($id);
    
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'year_of_production' => 'sometimes|integer',
            'image_url' => 'sometimes|file|image|max:10240', // Ensure file is optional and meets criteria
            'brand_id' => 'sometimes|exists:brands,id',
            'car_id' => 'sometimes|exists:cars,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
    
        // Handle image upload
        $logoPath = $carparts->image_url; // Initialize with current image URL
    
        if ($request->hasFile('image_url')) {
            $logoFile = $request->file('image_url');
            $logoPath = $logoFile->store('carpart_logos', 'public');
            // Optionally delete the old image here if needed
        }
    
        // Update the car part record using the merged data
        $carparts->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => (float) $request->input('price'),
            'year_of_production' => (int) $request->input('year_of_production'),
            'brand_id' => $request->input('brand_id'),
            'car_id' => $request->input('car_id'),
            'image_url' => $logoPath,
        ]);
    
        // Return the updated car part as a resource
        return response()->json($carparts);
    }

    public function destroy(CarPart $carPart)
    {
        $carPart->delete();
        return response()->json(null, 204);
    }
}