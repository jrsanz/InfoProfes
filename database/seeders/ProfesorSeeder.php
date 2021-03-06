<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Profesor;
use App\Models\Subject;
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
        Profesor::factory(20)->has(Grade::factory()->count(3))->has(Subject::factory()->count(1))->create();
    }
}
