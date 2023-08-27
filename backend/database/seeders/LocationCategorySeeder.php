<?php

namespace Database\Seeders;

use App\Models\LocationCategory;
use Illuminate\Database\Seeder;

class LocationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gasstation = new LocationCategory();
        $gasstation->name = 'Gas Station';
        $gasstation->saveOrFail();

        $gasstation = new LocationCategory();
        $gasstation->name = 'Garage';
        $gasstation->saveOrFail();
    }
}
