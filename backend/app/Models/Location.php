<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory, UuidPrimaryKey;

    protected $hidden = ['deleted_at'];

    public function fuelExpenses(): HasMany
    {
        return $this->hasMany(FuelExpense::class);
    }

    public function locationCategory(): BelongsTo
    {
        return $this->belongsTo(LocationCategory::class);
    }
}
