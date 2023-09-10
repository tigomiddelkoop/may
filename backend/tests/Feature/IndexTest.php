<?php

namespace Tests\Feature;

use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    public function it_should_respond_with_informational_data_about_instance(): void
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'version' => '0.0.1',
                    'instance_info' => [
                        'vehicles' => 0,
                    ],
                ],
                'message' => 'Welcome to May, a third generation Vehicle Tracking Tool',
            ]);
    }
}
