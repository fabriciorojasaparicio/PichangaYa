<?php

namespace Database\Factories;

use App\Models\Cancha;
use App\Models\CentroDeportivo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CanchaFactory extends Factory
{
    protected $model = Cancha::class;

    public function definition(): array
    {
        return [
            'nombre' => 'Cancha ' . $this->faker->numberBetween(1, 10),
            'descripcion' => $this->faker->sentence(),
            'precio_por_bloque' => $this->faker->numberBetween(5000, 20000),
            'max_bloques_reserva' => $this->faker->numberBetween(1, 4),
            'activo' => true,
            'centro_deportivo_id' => CentroDeportivo::factory(),
        ];
    }
}
