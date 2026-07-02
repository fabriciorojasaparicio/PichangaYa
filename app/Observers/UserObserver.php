<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\User;

class UserObserver
{
    public function creating(User $user): void
    {
        // Asignar rol "cliente" por defecto si no tiene uno
        if (!$user->role_id) {
            $clienteRole = Role::where('nombre', 'cliente')->first();
            if ($clienteRole) {
                $user->role_id = $clienteRole->id;
            } else {
                // Si no existe el rol, crearlo
                $role = Role::create(['nombre' => 'cliente']);
                $user->role_id = $role->id;
            }
        }
    }
}
