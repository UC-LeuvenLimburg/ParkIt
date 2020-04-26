<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function test_home_route_test()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_login_redirect_test()
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

    public function test_user_cannot_view_users()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/users');

        $response->assertForbidden();
    }
}
