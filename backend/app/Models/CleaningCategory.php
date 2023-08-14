<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CleaningCategory extends Model
{
    use HasFactory;

    public function cleaningExpenses(): HasMany
    {
        return $this->hasMany(CleaningExpenses::class);
    }
}
