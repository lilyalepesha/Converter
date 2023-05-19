<?php

namespace Tests\Feature\Api\v1;

use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_logout_unauthorized()
    {
        $response = $this->postJson(route('api.logout'));

        $response->assertStatus(401);
    }

    public function test_url_not_exists()
    {
        $response = $this->postJson('/not-exists')
            ->assertStatus(404);
    }

    public function test_correct_logout()
    {
        $response = $this->postJson(route('api.logout'))->assertUnauthorized();
        $response->assertJsonStructure([
            'message'
        ]);
    }

}
