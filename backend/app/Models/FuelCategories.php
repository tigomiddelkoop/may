<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FuelCategories extends Model
{
    use HasFactory;

    public function fuels(): hasMany
    {
        return $this->hasMany(Fuels::class);
    }
}
