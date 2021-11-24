<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'puntualidad' => $this->faker->randomElement([0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]),
            'personalidad' => $this->faker->randomElement([0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]),
            'aprendizaje_obtenido' => $this->faker->randomElement([0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]),
            'manera_evaluar' => $this->faker->randomElement([0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]),
            'calificacion_obtenida' => $this->faker->randomElement([0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]),
            'conocimiento' => $this->faker->randomElement([0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]),
            'categoria' => $this->faker->randomElement([
                'EXCELENTE', 'BARCO', 'ESTRICTO', 'FANTASMA', 'TERRIBLE',
                'FLEXIBLE', 'INTERACTIVO', 'REGULAR', 'RELAJADO', 'GROSERO']),
        ];
    }
}
