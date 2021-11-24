<?php

namespace Database\Factories;

use App\Models\Profesor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfesorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Profesor::class;


    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'apellido_paterno' => $this->faker->lastName(),
            'apellido_materno' => $this->faker->lastName(),
            'cu' => $this->faker->randomElement(['CUCEI', 'CUCEA', 'CUCS', 'CUAAD', 'CUCBA', 'CUCSH']),
        ];
    }
}
