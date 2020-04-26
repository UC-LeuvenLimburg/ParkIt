<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomeRouteTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
