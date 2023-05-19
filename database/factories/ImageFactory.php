<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Image::class;

    /**
     * @return array|mixed[]
     */
    public function definition()
    {
        return [
            'name' => fake()->imageUrl,
            'width' => fake()->numberBetween(20, 2499),
            'height' => fake()->numberBetween(20, 2499),
            'original_height' => fake()->numberBetween(20, 2499),
            'original_width' => fake()->numberBetween(20, 2499),
            'type' => fake()->mimeType(),
            'user_id' => fake()->numberBetween(1, 1000),
        ];
    }
}
