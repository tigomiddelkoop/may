<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicles extends Model
{
    use HasFactory;

    public function fuel(): BelongsTo
    {
        return $this->belongsTo(Fuels::class);
    }
}
