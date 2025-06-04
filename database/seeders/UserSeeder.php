<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Nabila',
                'email' => 'nabilla@gmail.com',
                'password' => Hash::make('LariPagi@2025'), // password default
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rainova',
                'email' => 'rainova@gmail.com',
                'password' => Hash::make('LariPagi@2025'),
                'role' => 'pasien',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sintia',
                'email' => 'Sintia@gmail.com',
                'password' => Hash::make('LariPagi@2025'),
                'role' => 'dokter',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}