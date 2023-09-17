<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityExpense extends Model
{
    use HasFactory, SoftDeletes, UuidPrimaryKey;

    protected $hidden = ['deleted_at'];

    public function activityCategory(): BelongsTo
    {
        return $this->belongsTo(ActivityCategory::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
