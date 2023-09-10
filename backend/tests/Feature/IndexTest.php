<?php

namespace Tests\Feature;

use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    public function make_sure_that_may_responds_on_the_root_url_with_information_about_itself(): void
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'version' => '0.0.1',
                ],
                'message' => 'Welcome to May, a third generation Vehicle Tracking Tool',
            ]);
    }
}
