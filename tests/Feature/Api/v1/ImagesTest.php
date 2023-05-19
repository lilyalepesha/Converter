<?php

namespace Tests\Feature\Api\v1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ImagesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
    }
    public function test_images_unauthorized()
    {
        $response = $this->getJson(route('api.index'));

        $response->assertStatus(401);
    }

    public function test_images_success(){
        Sanctum::actingAs($this->user);
        $response = $this->getJson(route('api.index'));

        $response->assertStatus(200);

        $response->assertJsonStructure([
           'status',
           'data',
        ]);
    }

    public function test_url_not_exists(){
        $response = $this->postJson('/not-exists')
            ->assertStatus(404);
    }
}
