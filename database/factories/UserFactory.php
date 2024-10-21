<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => 'asdf1234', // password
            // 'two_factor_secret' => null,
            // 'two_factor_recovery_codes' => null,
            'remember_token'    => Str::random(10),
            //            'profile_photo_path' => null,

        ];
    }

    // assign role to user
    public function role($role): UserFactory
    {
        return $this->state(fn(array $attributes) => [
            'role' => $role,
        ]);
    }
}
