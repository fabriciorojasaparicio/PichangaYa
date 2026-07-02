<?php

namespace Database\Factories;

use App\Models\Cancha;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservaFactory extends Factory
{
    protected $model = Reserva::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'cancha_id' => Cancha::factory(),
            'fecha' => $this->faker->date(),
            'total' => $this->faker->randomFloat(2, 100, 1000),
            'estado' => $this->faker->randomElement(['pendiente', 'confirmada', 'cancelada']),
        ];
    }
}
