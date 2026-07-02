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

class ReservasApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_propietario_can_list_confirm_and_cancel_reservas()
    {
        $this->withoutMiddleware(\App\Http\Middleware\EnsurePropietario::class);

        $prop = User::create(["name" => "Prop", "email" => "prop2@example.test", "password" => Hash::make('secret')]);
        $cliente = User::create(["name" => "Cli2", "email" => "cli2@example.test", "password" => Hash::make('secret')]);

        if (! Schema::hasTable('regiones')) {
            Schema::create('regiones', function (Blueprint $table) {
                $table->id();
                $table->string('nombre')->nullable();
                $table->timestamps();
            });
        }

        $centro = CentroDeportivo::create(["nombre" => 'Centro 2', "user_id" => $prop->id, "direccion" => 'Calle 2']);
        $cancha = Cancha::create(["nombre" => 'Cancha 2', "centro_deportivo_id" => $centro->id]);

        $reserva = Reserva::create(["user_id" => $cliente->id, "cancha_id" => $cancha->id, "estado" => 'pendiente', "fecha" => now()]);

        Sanctum::actingAs($prop);

        $this->getJson('/api/propietario/reservas')->assertStatus(200)->assertJsonCount(1, 'data');

        $this->postJson("/api/propietario/reservas/{$reserva->id}/confirm")->assertStatus(200);
        $this->assertDatabaseHas('reservas', ['id' => $reserva->id, 'estado' => 'confirmado']);

        $this->postJson("/api/propietario/reservas/{$reserva->id}/cancel")->assertStatus(200);
        $this->assertDatabaseHas('reservas', ['id' => $reserva->id, 'estado' => 'cancelado']);
    }
}
