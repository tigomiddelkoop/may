<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Locations extends Model
{
    use HasFactory;

    public function repairExpenses(): HasMany
    {
        return $this->hasMany(RepairExpenses::class);
    }

    public function cleaningExpenses(): HasMany
    {
        return $this->hasMany(CleaningExpenses::class);
    }

    public function fuelExpenses(): HasMany
    {
        return $this->hasMany(FuelExpenses::class);
    }


}
