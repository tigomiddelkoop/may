<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    public function defaultFuel(): BelongsTo
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

    public function fuelExpenses(): HasMany
    {
        return $this->hasMany(FuelExpense::class);
    }
}
