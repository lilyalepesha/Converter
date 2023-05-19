<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 *
 */
class ImageOperationsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var mixed
     */
    protected $user;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
    }

    /**
     * @return void
     */
    public function test_successful_main_page_open()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('pages.index');
    }

    /**
     * @return void
     */
    public function test_store_and_create_image()
    {
        Storage::fake('links');

        $file = $this->createImage('jpg', 500, 500, 1000);


        $response = $this->actingAs($this->user)->post(route('service.store'), [
            'image' => [
                $file,
            ],
        ])->assertRedirect(route('service.download'));

        Storage::disk('links')->exists($file->hashName());

        $this->assertDatabaseHas('images', [
            'type' => $file->extension(),
            'user_id' => $this->user->id,
        ]);
    }

    /**
     * @return void
     */
    public function test_user_dont_store_image()
    {
        $response = $this->actingAs($this->user)
            ->post(route('service.store', []))
            ->assertRedirect(route('service.index'));
        $response->assertInvalid();
        $response->assertSessionHasErrors(['image']);
    }

    /**
     * @return void
     */
    public function test_max_size_image()
    {
        $response = $this->actingAs($this->user)
            ->post(route('service.store', [
                'image' => [
                    $this->createImage('jpg', 225, 1000, 5999),
                ],
            ]))->assertRedirect(route('service.index'));
        $response->assertInvalid();
    }

    /**
     * @return void
     */
    public function test_image_mime_type_incorrect()
    {
        $response = $this->actingAs($this->user)
            ->post(route('service.store', [
                'image' => [
                    $this->createImage('notfound', 225, 1000, 5000),
                ],
            ]))->assertRedirect(route('service.index'));
        $response->assertInvalid();
    }

    /**
     * @return void
     */
    public function test_image_array_type()
    {
        $response = $this->actingAs($this->user)
            ->post(route('service.store', [
                $this->createImage('jpg', 225, 1000, 1255),
            ]))->assertRedirect(route('service.index'));
        $response->assertInvalid();
    }

    /**
     * @return void
     */
    public function test_image_width_and_height_less_then_min_value()
    {
        $response = $this->actingAs($this->user)
            ->post(route('service.store', [
                'image' => [
                    $this->createImage('jpg', 1, 1, 1255),
                ],
            ]))->assertRedirect(route('service.index'));
        $response->assertInvalid();
    }

    /**
     * @return void
     */
    public function test_image_width_and_height_more_then_max_value()
    {
        $response = $this->actingAs($this->user)
            ->post(route('service.store', [
                'image' => [
                    $this->createImage('jpg', 5555, 5555, 1255),
                ],
            ]))->assertRedirect(route('service.index'));
        $response->assertInvalid();
    }

    /**
     * @return void
     */
    public function test_user_not_registered()
    {
        $response = $this->post(route('service.store'), [
            'image' => [
                $this->createImage('jpg', 500, 200, 1500),
            ],
        ])->assertRedirect(route('login.index'));
    }

    /**
     * @return void
     */
    public function test_url_not_exists()
    {
        $response = $this->post('/not-exists')
            ->assertStatus(404);
    }

    public function test_max_count_of_images()
    {

        $images = [];
        for ($i = 0; $i <= 1000; $i++) {
            $images[] = $this->createImage('jpg', 2666, 2666, 1255);
        }

        $response = $this->actingAs($this->user)
            ->post(route('service.store'), ['image' => $images]);

        $response->assertRedirect(route('service.index'));

        $response->assertSessionHasErrors(['image']);

    }
}
