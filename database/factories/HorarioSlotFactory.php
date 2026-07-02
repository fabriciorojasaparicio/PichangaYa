<?php

namespace Database\Factories;

use App\Models\Cancha;
use App\Models\HorarioSlot;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioSlotFactory extends Factory
{
    protected $model = HorarioSlot::class;

    public function definition(): array
    {
        $horaInicio = $this->faker->numberBetween(8, 20);
        $horaFin = $horaInicio + 1;

        return [
            'cancha_id' => Cancha::factory(),
            'fecha' => $this->faker->date(),
            'hora_inicio' => sprintf('%02d:00:00', $horaInicio),
            'hora_fin' => sprintf('%02d:00:00', $horaFin),
            'estado' => $this->faker->randomElement(['libre', 'reservado', 'bloqueado']),
        ];
    }
}
