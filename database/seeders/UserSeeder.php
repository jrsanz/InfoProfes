<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jesús Sánchez',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'type_of_user' => 'admin',
        ]);

        User::create([
            'name' => 'José Lopez',
            'email' => 'correo@correo.com',
            'email_verified_at' => now(),
            'password' => Hash::make('asdfghjklñ'),
            'type_of_user' => 'user',
        ]);

        User::create([
            'name' => 'Juan García',
            'email' => 'prueba@prueba.com',
            'email_verified_at' => now(),
            'password' => Hash::make('qazwsxedc'),
            'type_of_user' => 'user',
        ]);
    }
}
