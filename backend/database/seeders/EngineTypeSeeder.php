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
        $combustion->id = 'ffba6c4f-4504-4038-8ffc-b90e102c29e0';
        $combustion->name = 'Combustion';
        $combustion->saveOrFail();

        $electric = new EngineType();
        $electric->id = '53ceca61-7426-4bf7-9306-7c6419fe91ae';
        $electric->name = 'Electric';
        $electric->saveOrFail();
    }
}
