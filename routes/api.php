<?php

use Illuminate\Support\Facades\Route;

// Basic API index
Route::get('/', function () {
    return ['message' => 'Hello API'];
});

// Propietario API endpoints (require auth:sanctum)
Route::middleware(['auth:sanctum', \App\Http\Middleware\EnsurePropietario::class])
    ->prefix('propietario')
    ->name('api.propietario.')
    ->group(function () {
        // Clientes
        Route::get('clientes', [\App\Http\Controllers\Api\Propietario\ClienteController::class, 'index'])->name('clientes.index');
        Route::get('clientes/{cliente}', [\App\Http\Controllers\Api\Propietario\ClienteController::class, 'show'])->name('clientes.show');
        Route::post('clientes/{cliente}/block', [\App\Http\Controllers\Api\Propietario\ClienteController::class, 'block'])->name('clientes.block');
        Route::post('clientes/{cliente}/unblock', [\App\Http\Controllers\Api\Propietario\ClienteController::class, 'unblock'])->name('clientes.unblock');

        // Reservas
        Route::get('reservas', [\App\Http\Controllers\Api\Propietario\ReservaController::class, 'index'])->name('reservas.index');
        Route::post('reservas/{reserva}/confirm', [\App\Http\Controllers\Api\Propietario\ReservaController::class, 'confirm'])->name('reservas.confirm');
        Route::post('reservas/{reserva}/cancel', [\App\Http\Controllers\Api\Propietario\ReservaController::class, 'cancel'])->name('reservas.cancel');
    });
