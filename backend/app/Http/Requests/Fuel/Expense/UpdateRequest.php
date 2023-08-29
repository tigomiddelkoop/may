<?php

namespace App\Http\Requests\Fuel\Expense;

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
            'fuel_id' => 'numeric|exists:App\Models\Fuel,id',
            'vehicle_id' => 'numeric|exists:App\Models\Vehicle,id',
            'location_id' => 'numeric|exists:App\Models\Location,id',

            'fuel_quantity' => 'numeric',
            'fuel_price' => 'numeric',

            'odo_reading' => 'numeric',

            'filled_up' => 'boolean',

            'note' => 'string'
        ];
    }
}
