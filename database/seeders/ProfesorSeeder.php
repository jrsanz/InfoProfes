<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Profesor;
use Illuminate\Database\Seeder;

class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profesor::create([
            'nombre' => 'Juan',
            'apellido_paterno' => 'Perez',
            'apellido_materno' => 'Torres',
            'cu' => 'CUCEI',
            'verificado' => true,
        ]);

        Profesor::factory(20)->has(Grade::factory()->count(1))->create();
    }
}
