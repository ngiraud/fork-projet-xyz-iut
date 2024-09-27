<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Code>
 */
class CodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => Str::upper(fake()->bothify('????-####-????')),
            'host_id' => User::factory(),
            'guest_id' => null,
            'consumed_at' => null,
        ];
    }

    public function consumed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'guest_id' => User::factory(),
                'consumed_at' => fake()->dateTimeThisMonth(),
            ];
        });
    }
}
