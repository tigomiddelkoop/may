<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class TestVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'license_plate' => '00-AAA-0',
            'license_plate_country' => 'NLD',
            'make' => 'Peugeot',
            'model' => '308',
            'vin_number' => 'AA0AAAAA0AA000000',
            'initial_kilometers' => 160000,
            'default_fuel_id' => '1a9157a7-ae5f-4cf9-9883-c9d26c082cba',
            'engine_type_id' => 'ffba6c4f-4504-4038-8ffc-b90e102c29e0',
            'vehicle_type_id' => 'e66c1b94-2649-40de-a71a-c2f1df703c0f',

            'added_by' => 1,
        ]);

        Vehicle::create([
            'license_plate' => '11-BBB-1',
            'license_plate_country' => 'NLD',
            'make' => 'Peugeot',
            'model' => '208',
            'vin_number' => 'BB0BBBBB0BB000000',
            'initial_kilometers' => 160000,
            'default_fuel_id' => '706b6ced-713f-4419-b2c7-359ba4aa5561',
            'engine_type_id' => 'ffba6c4f-4504-4038-8ffc-b90e102c29e0',
            'vehicle_type_id' => 'e1445c7a-a601-4f6d-a943-5cc7c064b935',

            'added_by' => 1,
        ]);
    }
}
