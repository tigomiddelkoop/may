<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FuelType extends Model
{
    use HasFactory, UuidPrimaryKey;

    protected $hidden = ['deleted_at'];

    protected $fillable = ['name'];

    public function fuels(): hasMany
    {
        return $this->hasMany(Fuel::class);
    }
}
