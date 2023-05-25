<?php

namespace Database\Factories;

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
    public function definition(): array {
        // Create name
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();

        // Create email
        $email = Str::lower($firstName) . '.' . Str::lower($lastName) . '@example' . fake()->randomElement(['.com', '.org', '.net']);

        // Fake date
        $date = fake()->dateTimeBetween('-3 year', 'now');

        // Return definition
        return [
            'name' => $firstName . ' ' . $lastName,
            'email' => $email,
            'phone' => fake()->unique()->phoneNumber(),
            'password' => Hash::make('password'),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
