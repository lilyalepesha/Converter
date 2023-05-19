<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;


    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_successful()
    {
        $response = $this->post(route('login.store'), [
            'email' => $this->user->email,
            'password' => 'password',
        ])->assertRedirect(route('service.index'));
    }

    public function test_incorrect_email()
    {
        $response = $this->post(route('login.store'), [
            'email' => 'not-email',
            'password' => 'password',
        ])->assertRedirect();
    }

    public function test_fields_are_required()
    {
        $response = $this->post(route('login.store'), [
        ])->assertRedirect();
        $response->assertSessionHasErrors('email', 'password');
    }

    public function test_password_less_then_min()
    {
        $response = $this->post(route('login.store'), [
            'email' => $this->user->email,
            'password' => 123,
        ])->assertRedirect();
        $response->assertSessionHasErrors('password');
    }
}
