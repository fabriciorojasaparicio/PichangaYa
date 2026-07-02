<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

try {
    // Crear datos básicos sin foreign keys para prueba
    $centro = App\Models\CentroDeportivo::create([
        'user_id' => 1,
        'nombre' => 'Centro Deportivo 1',
        'direccion' => 'Dirección 1',
        
        
        
    ]);

    // Crear cancha
    $cancha = App\Models\Cancha::create([
        'nombre' => 'Cancha 1',
        'centro_deportivo_id' => $centro->id,
        'precio_por_bloque' => 20.00,
        'max_bloques_reserva' => 4,
        'activo' => true
    ]);

    // Crear configuración de horario
    $config = App\Models\HorarioConfig::create([
        'cancha_id' => $cancha->id,
        'dia_semana' => 1, // Lunes
        'hora_inicio' => '09:00:00',
        'hora_fin' => '18:00:00',
        'activo' => true
    ]);

    echo "Datos de prueba creados exitosamente\n";
    echo "Centro ID: {$centro->id}\n";
    echo "Cancha ID: {$cancha->id}\n";
    echo "Config ID: {$config->id}\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
