<?php

namespace Tests\Feature\Fuels;

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

    }

    /** @test */
    public function it_should_error_when_trying_to_give_a_wrong_relation_uuid(): void
    {

    }

    /** @test */
    public function it_should_error_when_trying_to_update_an_record_with_non_existing_relation_id(): void
    {

    }

    /** @test */
    public function it_should_error_when_trying_to_use_the_wrong_data_types(): void
    {

    }

    /** @test */
    public function it_should_return_a_404_when_trying_to_update_an_non_existing_fuel(): void
    {

    }
}
