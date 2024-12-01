<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Default password for all users
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user is a demo user for testing purposes.
     *
     * @return $this
     */
    public function demoUser(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => bcrypt('demo-password'), // Demo password
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
