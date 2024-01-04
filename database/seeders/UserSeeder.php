<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => "Colaborador",
            'email' => 'colaborador@teste.com',
            'cpf' => "12345678900",
            'password' => Hash::make('colaborador@123'),
            'tipo_usuario' => "colaborador",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => "Cliente",
            'email' => 'cliente@teste.com',
            'cpf' => "00987654321",
            'password' => Hash::make('cliente@123'),
            'tipo_usuario' => "cliente",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
