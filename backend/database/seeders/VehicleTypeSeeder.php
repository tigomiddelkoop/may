<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $car = new VehicleType();
        $car->name = 'Car';
        $car->saveOrFail();

        $truck = new VehicleType();
        $truck->name = 'Truck';
        $truck->saveOrFail();

        $motor = new VehicleType();
        $motor->name = 'Motor';
        $motor->saveOrFail();
    }
}
