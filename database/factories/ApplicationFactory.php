<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'internalKey' => $this->faker->name(),
            'displayName' => $this->faker->name(),
            'AppTypeCdVUID' => $this->faker->numberBetween(12, 15),
            'weight' => 0,
        ];
    }
}
