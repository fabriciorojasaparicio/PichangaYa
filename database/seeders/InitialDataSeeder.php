<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Deporte;
use App\Models\Caracteristica;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Deportes
        $deportes = [
            ['nombre' => 'Fútbol 5', 'icono' => 'sports_soccer'],
            ['nombre' => 'Fútbol 7', 'icono' => 'sports_soccer'],
            ['nombre' => 'Tenis', 'icono' => 'sports_tennis'],
            ['nombre' => 'Pádel', 'icono' => 'sports_tennis'],
            ['nombre' => 'Vóley', 'icono' => 'sports_volleyball'],
            ['nombre' => 'Básquet', 'icono' => 'sports_basketball'],
        ];

        foreach ($deportes as $deporte) {
            Deporte::firstOrCreate(['nombre' => $deporte['nombre']], $deporte);
        }

        // Características: Servicios
        $servicios = [
            ['nombre' => 'Estacionamiento', 'tipo' => 'servicio', 'icono' => 'local_parking'],
            ['nombre' => 'Vestuarios', 'tipo' => 'servicio', 'icono' => 'wc'],
            ['nombre' => 'Duchas', 'tipo' => 'servicio', 'icono' => 'shower'],
            ['nombre' => 'Buffet / Bar', 'tipo' => 'servicio', 'icono' => 'restaurant'],
            ['nombre' => 'WiFi', 'tipo' => 'servicio', 'icono' => 'wifi'],
            ['nombre' => 'Alquiler de pelotas', 'tipo' => 'servicio', 'icono' => 'sports_soccer'],
        ];

        // Características: Infraestructura
        $infraestructuras = [
            ['nombre' => 'Cancha Techada', 'tipo' => 'infraestructura', 'icono' => 'roofing'],
            ['nombre' => 'Césped Sintético', 'tipo' => 'infraestructura', 'icono' => 'grass'],
            ['nombre' => 'Piso de Goma', 'tipo' => 'infraestructura', 'icono' => 'layers'],
            ['nombre' => 'Iluminación LED', 'tipo' => 'infraestructura', 'icono' => 'lightbulb'],
            ['nombre' => 'Tribunas', 'tipo' => 'infraestructura', 'icono' => 'stadium'],
        ];

        $caracteristicas = array_merge($servicios, $infraestructuras);

        foreach ($caracteristicas as $caracteristica) {
            Caracteristica::firstOrCreate(['nombre' => $caracteristica['nombre'], 'tipo' => $caracteristica['tipo']], $caracteristica);
        }
    }
}
