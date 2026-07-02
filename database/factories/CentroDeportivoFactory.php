<?php

namespace Database\Factories;

use App\Models\CentroDeportivo;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CentroDeportivoFactory extends Factory
{
    protected $model = CentroDeportivo::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company() . ' Sports Center',
            'direccion' => $this->faker->address(),
            'user_id' => \App\Models\User::factory(),
            'region_id' => null,
            'ciudad_id' => null,
            'distrito_id' => null,
            'latitud' => $this->faker->latitude(),
            'longitud' => $this->faker->longitude(),
        ];
    }
}
