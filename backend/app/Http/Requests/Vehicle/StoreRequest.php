<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'model' => 'required|string',
            'make' => 'required|string',
            'license_plate' => 'required|string',
            'license_plate_country' => 'required|size:3',
            'vin_number' => 'string',

            'initial_kilometers' => 'numeric',

            'vehicle_type_id' => 'required|numeric',
            'engine_type_id' => 'required|numeric',
            'default_fuel_type_id' => 'required|numeric',

            'note' => 'text',
        ];
    }
}
