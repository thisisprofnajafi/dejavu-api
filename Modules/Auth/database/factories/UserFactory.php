<?php

namespace Modules\Auth\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Auth\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Auth\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

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
            'password' => Hash::make('password'), // Default password for testing
            'remember_token' => Str::random(10),
            'referral_code' => $this->generateReferralCode(),
        ];
    }

    /**
     * Generate a random referral code
     *
     * @return string
     */
    protected function generateReferralCode(): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        
        for ($i = 0; $i < 12; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $code;
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Create an admin user
     */
    public function admin(): static
    {
        return $this->state(function (array $attributes) {
            return $attributes;
        })->afterCreating(function (User $user) {
            $user->assignRole('admin');
        });
    }

    /**
     * Create an author user
     */
    public function author(): static
    {
        return $this->state(function (array $attributes) {
            return $attributes;
        })->afterCreating(function (User $user) {
            $user->assignRole('author');
        });
    }

    /**
     * Create a visitor user
     */
    public function visitor(): static
    {
        return $this->state(function (array $attributes) {
            return $attributes;
        })->afterCreating(function (User $user) {
            $user->assignRole('visitor');
        });
    }
} 