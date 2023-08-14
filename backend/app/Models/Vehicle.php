<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vehicle extends Model
{
    use HasFactory;

    public function fuel(): BelongsTo
    {
        return $this->belongsTo(Fuel::class);
    }

    public function engineType(): HasOne
    {
        return $this->hasOne(EngineType::class);
    }

    public function vehicleType(): HasOne
    {
        return $this->hasOne(VehicleType::class);
    }
}
