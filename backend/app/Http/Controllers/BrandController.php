<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return BrandResource::collection($brands);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string', // Require an array field named images
            'country_of_origin' => 'required|string', // Each file in the array should be an image and up to 10 MB
            'logo_url' => 'file|image|max:10240',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $logoFile = $request->file('logo_url');
        if($logoFile){
            $logoPath = $logoFile->store('brand_logos', 'public');
        }
        else{
            $logoPath = null;
        }

        // Create a new car
        $brand = Brand::create([
            'name' => $request->name, 
            'country_of_origin' => $request->country_of_origin,
            'logo_url' => $logoPath, 
        ]);

        // Return the new car as a resource
        return $brand;
    } 
    
    public function show($id)
    {
        // Retrieve the car using the provided id
        return Brand::findOrFail($id);
    }

    public function update(Request $request, int $id)
    {
       

        // Find the car record using the provided ID
        $brand = Brand::findOrFail($id);

        $requestData = $request->all();

        $brand->deleteLogo($id);
        
        // Check each field in the validated data
        foreach ($requestData as $key => $value) {
            // If the value is null, replace it with the existing value from $car
            if ($value === null || $value === '') {
                $requestData[$key] = $brand->$key;
            }
        }
        
        $validator = Validator::make($requestData, [
            'name' => 'sometimes|string', // Require an array field named images
            'country_of_origin' => 'sometimes|string', // Each file in the array should be an image and up to 10 MB
            'logo_url' => 'file|image|max:10240',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $logoFile = $request->file('logo_url');

        if($logoFile){
            $logoPath = $logoFile->store('brand_logos', 'public');
        }
        else{
            $logoPath = null;
        }
        
        // Update the car record using the merged data
        $brand->update([
            'name' => $requestData['name'], 
            'country_of_origin' => $requestData['country_of_origin'],
            'logo_url' => $logoPath,
        ]);
                
        // Return the updated car as a resource
        return $brand;
    }
    
    public function destroy($id): bool
    {
        $brand = Brand::findOrFail($id);
        $brand->deleteLogo($id); 
        return $brand->delete();
    }

}
