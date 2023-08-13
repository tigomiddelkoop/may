<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expenses extends Model
{
    use HasFactory;

    public function fuel(): BelongsTo
    {
        return $this->belongsTo(Fuels::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicles::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Locations::class);
    }
}
