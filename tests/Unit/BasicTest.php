<?php

namespace Tests\Unit;

use Tests\TestCase;

class BasicTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->post('api/auth/login');
        $response->assertStatus(401);

        $response = $this->get('api/clubs');
        $response->assertStatus(200);

        $response = $this->get('api/news');
        $response->assertStatus(200);

        $response = $this->get('api/leagues');
        $response->assertStatus(200);
    }
}
