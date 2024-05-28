<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use App\Http\Resources\CarResource;
use App\Http\Resources\CarImageResource;
use App\Http\Requests\Cars\CarStoreRequest;
use App\Http\Requests\Cars\CarUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

        // Delete the photo folder if it exists
        $photoFolder = "public/car_images/{$car->id}";
        if (Storage::exists($photoFolder)) {
            Storage::deleteDirectory($photoFolder);
        }

        return $car->delete();
    }

    public function storeCarImages(Request $request, int $id)
    {

        $validator = Validator::make($request->all(), [
            'images' => 'required|array', // Require an array field named images
            'images.*' => 'file|image|max:10240', // Each file in the array should be an image and up to 10 MB
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // Find the car record using the provided car ID
        $car = Car::findOrFail($id);

        // Get the uploaded image files from the request
        $imageFiles = $request->file('images');
        // Create a unique folder path for the car's images using the car ID
        $carFolder = 'car_images/' . $car->id;

        // Check if there are images to upload
        if ($imageFiles) {
            // Loop through each image file and save it to the car's folder
            foreach ($imageFiles as $imageFile) {

                // Save the image to storage in the car's folder
                $imagePath = $imageFile->store($carFolder, 'public');
                // dd($imagePath);

                // Create a new CarImage instance with the new image path
                $carImage = new CarImage([
                    'car_id' => $car->id,
                    'image_url' => $imagePath,
                    'mime_type' => $imageFile->getMimeType(),
                    'size' => $imageFile->getSize()
                ]);

                // Save the CarImage instance to associate it with the car
                $carImage->save();
            }
        }

        // Return a collection of the car's images as a resource
        return CarImageResource::collection($car->images);
    }
}
