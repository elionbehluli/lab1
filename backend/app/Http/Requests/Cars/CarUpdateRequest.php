<?php

namespace App\Http\Requests\Cars;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'model' => 'sometimes|string|max:255',
            'color' => 'sometimes|string|max:255',
            'year' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
            'mileage' => 'sometimes|integer',
            'transmission_type' => 'sometimes|string',
            'fuel_type' => 'sometimes|string',
            'engine_size' => 'sometimes|numeric',
            'number_of_seats' => 'sometimes|integer',
            'body_type' => 'sometimes',
            'features' => 'sometimes|json',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
