<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A Test for the home route
     *
     * @return void
     */
    public function testHomeRouteTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * A Test for the leases route
     *
     * @return void
     */
    public function testLeasesRouteTest()
    {
        $response = $this->get('/leases');
        $response->assertStatus(302);
    }

    /**
     * A Test for the leases route
     *
     * @return void
     */
    public function testRentablesRouteTest()
    {
        $response = $this->get('/rentables');
        $response->assertStatus(302);
    }

    /**
     * A Test for the leases route
     *
     * @return void
     */
    public function testUsersRouteTest()
    {
        $response = $this->get('/users');
        $response->assertStatus(302);
    }
}
