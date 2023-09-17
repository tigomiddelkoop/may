<?php

namespace Tests\Feature\Vehicles;

use Carbon\Carbon;
use Database\Seeders\TestVehicleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListVehiclesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->travelTo(Carbon::parse('2023-01-01T00:00:00'));
        $this->seed(); // Run general seeder
        $this->seed(TestVehicleSeeder::class);
    }

    /** @test */
    public function it_should_return_all_vehicles_created_by_user(): void
    {
        $response = $this->get('/vehicles');

        $response->assertStatus(200);
        $response->assertJson(
            [
                'message' => 'Data has been retrieved',
                'data' => [
                    [
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

                        "default_fuel" => [
                            "id" => "1a9157a7-ae5f-4cf9-9883-c9d26c082cba",
                            "name" => "E5",
                            "description" => "This petrol contains 5% ethanol",
                            "fuel_type_id" => "ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20"
                        ],
                        "engine_type" => [
                            "id" => "ffba6c4f-4504-4038-8ffc-b90e102c29e0",
                            "name" => "Combustion"
                        ],
                        "vehicle_type" => [
                            "id" => "e66c1b94-2649-40de-a71a-c2f1df703c0f",
                            "name" => "Car"
                        ]
                    ],
                    [
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

                        "default_fuel" => [
                            "id" => "706b6ced-713f-4419-b2c7-359ba4aa5561",
                            "name" => "E85",
                            "description" => "This petrol contains 85% ethanol",
                            "fuel_type_id" => "ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20"
                        ],
                        "engine_type" => [
                            "id" => "ffba6c4f-4504-4038-8ffc-b90e102c29e0",
                            "name" => "Combustion"
                        ],
                        "vehicle_type" => [
                            "id" => "e1445c7a-a601-4f6d-a943-5cc7c064b935",
                            "name" => "Truck"
                        ]
                    ],
                ],
            ]
        );
    }
}
