<?php

namespace Tests\Feature\Propietario;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\CentroDeportivo;
use App\Models\Cancha;
use App\Models\Reserva;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ClientesApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_propietario_can_list_and_block_unblock_clients()
    {
        $this->withoutMiddleware(\App\Http\Middleware\EnsurePropietario::class);

        $prop = User::create(["name" => "Prop", "email" => "prop@example.test", "password" => Hash::make('secret')]);
        $cliente = User::create(["name" => "Cli", "email" => "cli@example.test", "password" => Hash::make('secret'), "status" => 'active']);

        if (! Schema::hasTable('regiones')) {
            Schema::create('regiones', function (Blueprint $table) {
                $table->id();
                $table->string('nombre')->nullable();
                $table->timestamps();
            });
        }

        $centro = CentroDeportivo::create(["nombre" => 'Centro 1', "user_id" => $prop->id, "direccion" => 'Calle 1']);
        $cancha = Cancha::create(["nombre" => 'Cancha 1', "centro_deportivo_id" => $centro->id]);

        Reserva::create(["user_id" => $cliente->id, "cancha_id" => $cancha->id, "estado" => 'pendiente', "fecha" => now()]);

        Sanctum::actingAs($prop);

        $res = $this->getJson('/api/propietario/clientes');
        $res->assertStatus(200)->assertJsonCount(1, 'data');

        $this->postJson("/api/propietario/clientes/{$cliente->id}/block")->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $cliente->id, 'status' => 'inactive']);

        $this->postJson("/api/propietario/clientes/{$cliente->id}/unblock")->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $cliente->id, 'status' => 'active']);
    }
}
