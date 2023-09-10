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

    }

    /** @test */
    public function it_should_return_a_404_when_trying_to_retrieve_an_non_existing_fuel(): void
    {

    }

    /** @test */
    public function it_should_return_a_400_when_trying_to_use_an_invalid_uuid(): void
    {

    }
}
