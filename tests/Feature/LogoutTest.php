<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_logout_guest_test()
    {
        $response = $this->post(route('logout'))
            ->assertRedirect(route('login.index'));
    }

    public function test_auth_user_logout()
    {
        $user = $this->createUser();
        $response = $this->actingAs($user)->post(route('logout'))->assertRedirect(RouteServiceProvider::HOME);
    }
}
