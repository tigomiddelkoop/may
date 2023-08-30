<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityExpense extends Model
{
    use HasFactory, SoftDeletes;

    public function activityCategory(): BelongsTo
    {
        return $this->belongsTo(ActivityCategory::class);
    }
}
