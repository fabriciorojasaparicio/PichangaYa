<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

try {
    // Crear datos básicos para foreign keys
    DB::table('regiones')->insert(['id' => 1, 'nombre' => 'Región 1']);
    DB::table('ciudades')->insert(['id' => 1, 'nombre' => 'Ciudad 1', 'region_id' => 1]);
    DB::table('distritos')->insert(['id' => 1, 'nombre' => 'Distrito 1', 'ciudad_id' => 1]);

    echo "Datos básicos creados\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}