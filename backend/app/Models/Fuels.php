<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fuels extends Model
{
    use HasFactory;

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Locations::class);
    }

    public function fuelCategory(): BelongsTo
    {
        return $this->belongsTo(FuelCategory::class);
    }

    public function fuelExpenses(): HasMany
    {
        return $this->hasMany(FuelExpenses::class);
    }

}
