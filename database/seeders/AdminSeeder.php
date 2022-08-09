<?php

namespace Database\Seeders;

use App\Models\Administrador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Administrador::create([
            'NombreAdm' => 'Nestor Chela',
            'email' => 'admin@admin.com',
            'FechaCaducidadAdm' => '2099-01-01',
            'password' => Hash::make('12345678')
        ])->assignRole('Administrador');

        Administrador::create([
            'NombreAdm' => 'Klever Castillo',
            'email' => 'gestor@admin.com',
            'FechaCaducidadAdm' => '2022-06-21',
            'password' => Hash::make('12345678')
        ])->assignRole('Gestor de Contenido');
    }
}
