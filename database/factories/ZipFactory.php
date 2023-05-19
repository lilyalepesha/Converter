<?php

namespace Database\Factories;

use App\Models\Zip;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Zip>
 */
class ZipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Zip::class;

    /**
     * @return array|mixed[]
     */
    public function definition()
    {
        return [
            'name' => rand(0, 1000) . Str::random(10),
            'type' => fake()->text(10),
            'user_id' => 1,
        ];
    }
}
