<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuels extends Model
{
    use HasFactory;

    public function locations()
    {
        return $this->belongsToMany(Locations::class);
    }

}
