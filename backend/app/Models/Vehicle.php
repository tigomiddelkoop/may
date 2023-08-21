<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'make',
        'model',
        'initial_kilometers',
        'vin_number',
        'license_plate',
        'license_plate_country',
    ];

    protected $hidden = [
        'default_fuel_type_id',
        'engine_type_id',
        'vehicle_type_id'
    ];

    public function defaultFuelType(): BelongsTo
    {
        return $this->belongsTo(Fuel::class);
    }

    public function engineType(): BelongsTo
    {
        return $this->belongsTo(EngineType::class);
    }

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }
}
