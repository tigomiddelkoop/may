<?php

namespace Tests\Feature\Fuels;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowFuelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->travelTo(Carbon::parse('2023-01-01T00:00:00'));
        $this->seed();
    }


    /** @test */
    public function it_should_return_information_about_a_fuel(): void
    {
        $response = $this->get('/fuels/1a9157a7-ae5f-4cf9-9883-c9d26c082cba');

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'Data has been retrieved',
                'data' => [
                    'id' => '1a9157a7-ae5f-4cf9-9883-c9d26c082cba',
                    'name' => 'E5',
                    'description' => 'This petrol contains 5% ethanol',
                    'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',

                    'fuel_type' => [
                        'id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
                        'name' => 'GASOLINE',
                        'created_at' => '2023-01-01T00:00:00.000000Z',
                        'updated_at' => '2023-01-01T00:00:00.000000Z'
                    ],

                    'created_at' => '2023-01-01T00:00:00.000000Z',
                    'updated_at' => '2023-01-01T00:00:00.000000Z',
                ]
            ]);

    }

    /** @test */
    public function it_should_return_a_404_when_trying_to_retrieve_an_non_existing_fuel(): void
    {
        $response = $this->get('/fuels/40c6fb39-5e15-44c0-b27d-1fcc8353a062');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_should_return_a_400_when_trying_to_use_an_invalid_uuid(): void
    {
        $response = $this->get('/fuels/INVALID-UUID');

        $response
            ->assertStatus(400)
            ->assertJson(['data' => [], 'message' => 'Specified id is not valid a valid uuid']);

    }
}
