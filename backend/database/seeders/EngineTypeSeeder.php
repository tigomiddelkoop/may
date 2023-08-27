<?php

namespace Database\Seeders;

use App\Models\EngineType;
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
        $combustion->saveOrFail();

        $electric = new EngineType();
        $electric->name = 'Electric';
        $electric->saveOrFail();
    }
}
