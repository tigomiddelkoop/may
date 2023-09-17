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
        $car->id = 'e66c1b94-2649-40de-a71a-c2f1df703c0f';
        $car->name = 'Car';
        $car->saveOrFail();

        $truck = new VehicleType();
        $truck->id = 'e1445c7a-a601-4f6d-a943-5cc7c064b935';
        $truck->name = 'Truck';
        $truck->saveOrFail();

        $motor = new VehicleType();
        $motor->id = '8c35d9ad-a435-4405-9842-b9f081c2a6fb';
        $motor->name = 'Motor';
        $motor->saveOrFail();
    }
}
