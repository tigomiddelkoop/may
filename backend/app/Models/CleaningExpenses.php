<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CleaningExpenses extends Model
{
    use HasFactory;

    public function cleaningCategory(): BelongsTo {
        return $this->belongsTo(CleaningCategory::class);
    }
}
