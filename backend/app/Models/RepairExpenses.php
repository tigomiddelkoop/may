<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairExpenses extends Model
{
    use HasFactory;

    public function repairCategory(): BelongsTo
    {
        return $this->belongsTo(RepairCategories::class);
    }
}
