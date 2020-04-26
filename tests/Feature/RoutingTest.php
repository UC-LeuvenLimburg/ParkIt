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
    public function testLoginRedirctTest()
    {
        $urls = [
            '/leases',
            '/web/api/leases',
            '/web/api/all/leases',
            '/rentables',
            '/web/api/rentables',
            '/web/api/all/rentables',
            '/users',
            '/web/api/users',
            '/web/api/all/users',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            if ((int) $response->status() !== 302) {
                // (FAILED) did not return a 302
                $this->assertTrue(false);
            } else {
                // (success) all routes returned a redirect
                $this->assertTrue(true);
            }
        }
    }
}
