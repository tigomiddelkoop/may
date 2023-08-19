<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    public function repairExpenses(): HasMany
    {
        return $this->hasMany(RepairExpense::class);
    }

    public function cleaningExpenses(): HasMany
    {
        return $this->hasMany(CleaningExpense::class);
    }

    public function fuelExpenses(): HasMany
    {
        return $this->hasMany(FuelExpense::class);
    }

    public function locationCategory(): BelongsTo
    {
        return $this->belongsTo(LocationCategory::class);
    }
}
