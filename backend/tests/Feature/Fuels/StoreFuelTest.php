<?php

namespace Tests\Feature\Fuels;

use App\Models\Fuel;
use Database\Seeders\FuelSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class StoreFuelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->travelTo(Carbon::parse('2023-01-01T00:00:00'));
        $this->seed(FuelSeeder::class);
    }

    /** @test */
    public function it_should_store_a_fuel(): void
    {
        $response = $this->postJson('/fuels/', [
            'name' => 'TEST_FUEL',
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
        ]);

        $responseData = $response->decodeResponseJson();
        $response
            ->assertStatus(201)
            ->assertExactJson([
                'message' => 'Data has been stored',
                'data' => [
                    'id' => $responseData['data']['id'],
                    'name' => 'TEST_FUEL',
                    'description' => 'THIS IS A TEST FUEL',
                    'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
                    'created_at' => '2023-01-01T00:00:00.000000Z',
                    'updated_at' => '2023-01-01T00:00:00.000000Z',
                ],
            ]);

        $this->assertDatabaseHas(Fuel::class, [
            'id' => $responseData['data']['id'],
            'name' => 'TEST_FUEL',
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
        ]);
    }

    /** @test */
    public function it_should_error_when_trying_to_give_a_wrong_relation_uuid(): void
    {
        $response = $this->postJson('/fuels/', [
            'name' => 'TEST_FUEL',
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => 'INVALID-UUID',
        ]);

        $response
            ->assertStatus(422)
            ->assertExactJson([
                'message' => 'The fuel type id field must be a valid UUID.',
                'errors' => [
                    'fuel_type_id' => [
                        'The fuel type id field must be a valid UUID.',
                    ],
                ],
            ]);

        $this->assertDatabaseMissing(Fuel::class, [
            'name' => 'TEST_FUEL',
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
        ]);
    }

    /** @test */
    public function it_should_error_when_trying_to_store_a_record_with_non_existing_relation_id(): void
    {
        $response = $this->postJson('/fuels/', [
            'name' => 'TEST_FUEL',
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => 'a6abb307-04ce-4dc4-a1ae-04ffdf040c15',
        ]);

        $response
            ->assertStatus(422)
            ->assertExactJson([
                'message' => 'The selected fuel type id is invalid.',
                'errors' => [
                    'fuel_type_id' => [
                        'The selected fuel type id is invalid.',
                    ],
                ],
            ]);

        $this->assertDatabaseMissing(Fuel::class, [
            'name' => 'TEST_FUEL',
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => 'a6abb307-04ce-4dc4-a1ae-04ffdf040c15',
        ]);
    }

    /** @test */
    public function it_should_error_when_trying_to_use_the_wrong_data_types(): void
    {
        $response = $this->postJson('/fuels/', [
            'name' => 12,
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
        ]);

        $response
            ->assertStatus(422)
            ->assertExactJson([
                'message' => 'The name field must be a string.',
                'errors' => [
                    'name' => [
                        'The name field must be a string.',
                    ],
                ],
            ]);

        $this->assertDatabaseMissing(Fuel::class, [
            'name' => 12,
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
        ]);
    }
}
