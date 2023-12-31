<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'model' => 'string',
            'make' => 'string',
            'license_plate' => 'string',
            'license_plate_country' => 'size:3',
            'vin_number' => 'string',

            'initial_kilometers' => 'numeric',

            'vehicle_type_id' => 'uuid|exists:\App\Models\VehicleType,id',
            'engine_type_id' => 'uuid|exists:\App\Models\EngineType,id',
            'default_fuel_id' => 'uuid|exists:\App\Models\Fuel,id',

            'note' => 'string',
        ];
    }
}
