<?php

namespace Database\Seeders;

use App\Models\EngineType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EngineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $combustion = new EngineType();
        $combustion->name = 'Combustion';
        $combustion->save();

        $electric = new EngineType();
        $electric->name = 'Electric';
        $electric->save();
    }
}
