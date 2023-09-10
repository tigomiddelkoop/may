<?php

namespace Tests\Feature\Fuels;

use App\Models\Fuel;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyFuelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->travelTo(Carbon::parse('2023-01-01T00:00:00'));
        $this->seed();
    }

    /** @test */
    public function it_should_delete_a_fuel(): void
    {
        $response = $this->delete('/fuels/1a9157a7-ae5f-4cf9-9883-c9d26c082cba');

        $response
            ->assertStatus(200)
            ->assertJson([]);

        $this->assertSoftDeleted(Fuel::class, ['id' => '1a9157a7-ae5f-4cf9-9883-c9d26c082cba']);
    }

    /** @test */
    public function it_should_return_a_404_when_trying_to_delete_a_fuel_that_does_not_exist(): void
    {
        $response = $this->delete('/fuels/40c6fb39-5e15-44c0-b27d-1fcc8353a062');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_should_return_a_400_when_giving_incorrect_id(): void
    {
        $response = $this->delete('/fuels/12');

        $response
            ->assertStatus(400)
            ->assertJson(['data' => [], 'message' => 'Specified id is not valid a valid uuid']);
    }
    // Try to destroy an non existing fuel
}
