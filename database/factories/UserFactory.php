<?php

namespace Database\Factories;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    /**
     * @return array|mixed[]
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make(fake()->password),
            'role' => RoleEnum::USER->value,
            'remember_token' => Str::random(100),
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * @return UserFactory
     */
    public function userTesting()
    {
        return $this->state(fn(array $attributes) => [
            'password' => Hash::make('password'),
        ]);
    }

    /**
     * @return UserFactory
     */
    public function createAdmin()
    {
        return $this->state(fn(array $attributes) => [
            'role' => RoleEnum::ADMIN->value,
        ]);
    }
}
