<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use HasFactory, SoftDeletes, UuidPrimaryKey;

    protected $hidden = ['deleted_at'];


    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
