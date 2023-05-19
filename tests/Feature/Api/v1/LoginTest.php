<?php

namespace Tests\Feature\Api\v1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successful_login()
    {
        $response = $this->postJson(route('api.login'), [
            'email' => $this->user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'data' => [
                'id',
                'name',
                'email'
            ],
            'token'
        ]);
    }

    public function test_required_login_data(){
        $response = $this->postJson(route('api.login'));

        $response->assertUnprocessable();

        $response->assertJsonValidationErrors(['email', 'password']);

        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_incorrect_email_login(){
        $response = $this->postJson(route('api.login'), [
            'email' => 'not-email',
            'password' => 'password',
        ])->assertStatus(422);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['email']);

        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_min_incorrect_password_login(){
        $response = $this->postJson(route('api.login'), [
            'email' => $this->user->email,
            'password' => '123',
        ])->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    public function test_url_not_exists(){
        $response = $this->postJson('/not-exists')
            ->assertStatus(404);
    }
}
