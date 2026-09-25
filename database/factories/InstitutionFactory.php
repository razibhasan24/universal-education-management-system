<?php

namespace Database\Factories;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Institution>
 */
class InstitutionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'institution_type' => fake()->randomElement(Institution::types()),
            'code' => fake()->unique()->bothify('INST-###'),
            'eiin' => fake()->bothify('########'),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->bothify('##########'),
            'address' => fake()->address(),
            'logo' => null,
            'status' => Institution::STATUS_ACTIVE,
        ];
    }
}
