<?php

namespace Tests\Feature\Fuels;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListFuelsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->travelTo(Carbon::parse('2023-01-01T00:00:00'));
        $this->seed();
    }

    /** @test */
    public function it_should_return_all_available_fuels(): void
    {
        $response = $this->get('/fuels');

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Data has been retrieved',
                'data' => [
                    [
                        'id' => '1a9157a7-ae5f-4cf9-9883-c9d26c082cba',
                        'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
                        'name' => 'E5',
                        'description' => 'This petrol contains 5% ethanol',
                        'created_at' => '2023-01-01T00:00:00.000000Z',
                        'updated_at' => '2023-01-01T00:00:00.000000Z',
                    ],
                    [
                        'id' => '9e3b4a6d-ec48-46a4-9a52-f5df3e9bc640',
                        'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
                        'name' => 'E10',
                        'description' => 'This petrol contains 10% ethanol',
                        'created_at' => '2023-01-01T00:00:00.000000Z',
                        'updated_at' => '2023-01-01T00:00:00.000000Z',
                    ],
                    [
                        'id' => '706b6ced-713f-4419-b2c7-359ba4aa5561',
                        'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
                        'name' => 'E85',
                        'description' => 'This petrol contains 85% ethanol',
                        'created_at' => '2023-01-01T00:00:00.000000Z',
                        'updated_at' => '2023-01-01T00:00:00.000000Z',
                    ],
                ],
            ]);
    }
}
