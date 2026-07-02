<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure roles exist
        $adminRole      = Role::firstOrCreate(['nombre' => 'admin'],      ['nombre' => 'admin']);
        $propietarioRole= Role::firstOrCreate(['nombre' => 'propietario'],['nombre' => 'propietario']);
        $clienteRole    = Role::firstOrCreate(['nombre' => 'cliente'],    ['nombre' => 'cliente']);

        // Admin
        User::firstOrCreate(
            ['email' => 'admin@pichangaya.com'],
            [
                'name'     => 'Administrador PichangaYa',
                'password' => Hash::make('password'),
                'role_id'  => $adminRole->id,
            ]
        );

        // Propietario
        User::firstOrCreate(
            ['email' => 'propietario@pichangaya.com'],
            [
                'name'     => 'Carlos Propietario',
                'password' => Hash::make('password'),
                'role_id'  => $propietarioRole->id,
            ]
        );

        // Cliente
        User::firstOrCreate(
            ['email' => 'cliente@pichangaya.com'],
            [
                'name'     => 'Juan Cliente',
                'password' => Hash::make('password'),
                'role_id'  => $clienteRole->id,
            ]
        );
    }
}
