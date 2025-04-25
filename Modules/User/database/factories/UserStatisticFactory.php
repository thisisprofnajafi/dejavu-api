<?php

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\UserStatistic;
use Modules\User\Models\User;

class UserStatisticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserStatistic::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'login_count' => $this->faker->numberBetween(0, 100),
            'last_login_at' => $this->faker->dateTimeThisYear(),
            'last_login_ip' => $this->faker->ipv4(),
            'stores_count' => $this->faker->numberBetween(0, 10),
            'resumes_count' => $this->faker->numberBetween(0, 5),
            'views_count' => $this->faker->numberBetween(0, 1000),
            'downloads_count' => $this->faker->numberBetween(0, 500),
            'ratings_average' => $this->faker->randomFloat(1, 0, 5),
        ];
    }
} 