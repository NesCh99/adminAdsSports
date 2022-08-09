<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'NombreCli' => 'John Doe',
            'email' => 'john@email.com',
            'password' => Hash::make('12345678')
        ]);
        Cliente::create([
            'NombreCli' => 'Nes Ch',
            'email' => 'nes@email.com',
            'password' => Hash::make('12345678')
        ]);
        Cliente::create([
            'NombreCli' => 'Thaly Zarate',
            'email' => 'thaly@email.com',
            'password' => Hash::make('12345678')
        ]);
        Cliente::create([
            'NombreCli' => 'Stiven',
            'email' => 'stiven@email.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
