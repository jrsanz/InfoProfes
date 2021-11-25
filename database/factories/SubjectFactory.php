<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'materia' => $this->faker->regexify('[A-Z]{1}[0-9]{4}'),
            'nrc' => $this->faker->numberBetween(10000, 999999),
        ];
    }
}
