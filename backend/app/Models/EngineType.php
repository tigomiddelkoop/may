<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EngineType extends Model
{
    use HasFactory, UuidPrimaryKey;

    protected $hidden = ['deleted_at'];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
