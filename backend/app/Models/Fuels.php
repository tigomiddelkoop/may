<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fuels extends Model
{
    use HasFactory;

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Locations::class);
    }

    public function fuelCategory(): BelongsTo
    {
        return $this->belongsTo(FuelCategories::class);
    }

}
