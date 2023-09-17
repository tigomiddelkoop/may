<?php

namespace Tests\Feature\Fuels;

use App\Models\Fuel;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateFuelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->travelTo(Carbon::parse('2023-01-01T00:00:00'));
        $this->seed();
    }

    /** @test */
    public function it_should_update_a_fuel(): void
    {
        $response = $this->patchJson('/fuels/1a9157a7-ae5f-4cf9-9883-c9d26c082cba', [
            'name' => 'TEST_FUEL',
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
        ]);

        $responseData = $response->decodeResponseJson();
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'Data has been updated',
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
    public function it_should_error_when_trying_to_give_a_invalid_relation_uuid(): void
    {
        $response = $this->patchJson('/fuels/1a9157a7-ae5f-4cf9-9883-c9d26c082cba', [
            'name' => 'TEST_FUEL',
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => 'INVALID_UUID',
        ]);

        $responseData = $response->decodeResponseJson();
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
            //            'fuel_type_id' => 'INVALID_UUID', // This apparently breaks the test.
        ]);
    }

    /** @test */
    public function it_should_error_when_trying_to_update_an_record_with_non_existing_relation_id(): void
    {
        $response = $this->patchJson('/fuels/1a9157a7-ae5f-4cf9-9883-c9d26c082cba', [
            'name' => 'TEST_FUEL',
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => '4cd7562b-b902-4257-9403-a811f19cb85e',
        ]);

        $responseData = $response->decodeResponseJson();
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
            'fuel_type_id' => '4cd7562b-b902-4257-9403-a811f19cb85e',
        ]);
    }

    /** @test */
    public function it_should_error_when_trying_to_use_the_wrong_data_types(): void
    {
        $response = $this->patchJson('/fuels/1a9157a7-ae5f-4cf9-9883-c9d26c082cba', [
            'name' => 1234,
            'description' => 1234,
            'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
        ]);

        $responseData = $response->decodeResponseJson();
        $response
            ->assertStatus(422)
            ->assertExactJson([
                'message' => 'The name field must be a string. (and 1 more error)',
                'errors' => [
                    'name' => [
                        'The name field must be a string.',
                    ],
                    'description' => [
                        'The description field must be a string.',
                    ],
                ],
            ]);

        $this->assertDatabaseMissing(Fuel::class, [
            'name' => 1234,
            'description' => 1234,
            'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
        ]);
    }

    /** @test */
    public function it_should_return_a_404_when_trying_to_update_an_non_existing_fuel(): void
    {
        $response = $this->patchJson('/fuels/4cd7562b-b902-4257-9403-a811f19cb85e', [
            'name' => 'TEST_FUEL',
            'description' => 'THIS IS A TEST FUEL',
            'fuel_type_id' => 'ffe5d2a9-a5fa-4a11-a3e2-775cbeb57d20',
        ]);

        $response->assertStatus(404);
    }
}
