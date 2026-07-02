<?php

use App\Http\Controllers\Api\CanchaController as ApiCanchaController;
use App\Http\Controllers\Api\CentroController as ApiCentroController;
use App\Http\Controllers\Api\ReservaController as ApiReservaController;
use App\Http\Controllers\Propietario\AgendaController;
use App\Http\Controllers\Propietario\CanchaController;
use App\Http\Controllers\Propietario\CentroController;
use App\Http\Controllers\Propietario\DashboardController;
use App\Http\Controllers\Propietario\ReporteController;
use App\Http\Controllers\Propietario\ReservaController;
use App\Http\Middleware\EnsurePropietario;
use App\Http\Controllers\Teams\TeamInvitationController;
use App\Http\Middleware\EnsureTeamMembership;
use App\Models\CentroDeportivo;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::prefix('api')->group(function () {
    Route::get('/centros', [ApiCentroController::class, 'index']);
    Route::get('/centros/{id}', [ApiCentroController::class, 'show']);
    Route::get('/canchas/{id}', [ApiCanchaController::class, 'show']);
    Route::get('/canchas/{id}/slots', [ApiCanchaController::class, 'slots']);
    Route::post('/reservar', [ApiReservaController::class, 'store'])->middleware('auth');
    Route::get('/mis-reservas', [ApiReservaController::class, 'myReservations'])->middleware('auth');
});

Route::get('/centros', fn () => Inertia::render('Centros/Index'))->name('centros.index');
Route::get('/centros/{centro}', fn ($centro) => Inertia::render('Centros/Show', ['centroId' => $centro]))->name('centros.show');
Route::get('/canchas/{cancha}', fn ($cancha) => Inertia::render('Canchas/Show', ['canchaId' => $cancha]))->name('canchas.show');
Route::get('/mis-reservas', fn () => Inertia::render('MisReservas'))->middleware('auth')->name('mis.reservas');

Route::get('/', function () {
    $centros = CentroDeportivo::with(['ciudad', 'distrito', 'canchas.deportes', 'caracteristicas'])->limit(10)->get();
    $deportes = \App\Models\Deporte::all();
    $servicios = \App\Models\Caracteristica::where('tipo', 'servicio')->get();
    $infraestructuras = \App\Models\Caracteristica::where('tipo', 'infraestructura')->get();

    return Inertia::render('Welcome', [
        'centros' => $centros,
        'deportes' => $deportes,
        'servicios' => $servicios,
        'infraestructuras' => $infraestructuras
    ]);
})->name('home');

Route::prefix('propietario')
    ->middleware(['auth', EnsurePropietario::class])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('propietario.dashboard');
        Route::get('/agenda', [AgendaController::class, 'agenda'])->name('propietario.agenda');
        Route::get('/centros', [CentroController::class, 'index'])->name('propietario.centros.index');
        Route::get('/centros/create', [CentroController::class, 'create'])->name('propietario.centros.create');
        Route::post('/centros', [CentroController::class, 'store'])->name('propietario.centros.store');
        Route::get('/centros/{centro}/edit', [CentroController::class, 'edit'])->name('propietario.centros.edit');
        Route::put('/centros/{centro}', [CentroController::class, 'update'])->name('propietario.centros.update');
        Route::delete('/centros/{centro}', [CentroController::class, 'destroy'])->name('propietario.centros.destroy');
        Route::get('/canchas', [CanchaController::class, 'index'])->name('propietario.canchas.index');
        Route::get('/canchas/create', [CanchaController::class, 'create'])->name('propietario.canchas.create');
        Route::post('/canchas', [CanchaController::class, 'store'])->name('propietario.canchas.store');
        Route::get('/canchas/{cancha}/edit', [CanchaController::class, 'edit'])->name('propietario.canchas.edit');
        Route::put('/canchas/{cancha}', [CanchaController::class, 'update'])->name('propietario.canchas.update');
        Route::delete('/canchas/{cancha}', [CanchaController::class, 'destroy'])->name('propietario.canchas.destroy');
        Route::get('/reportes', [ReporteController::class, 'index'])->name('propietario.reportes.index');
        Route::get('/reservas', [ReservaController::class, 'index'])->name('propietario.reservas.index');
        Route::post('/reservas/{reserva}/confirm', [ReservaController::class, 'confirm'])->name('propietario.reservas.confirm');
        Route::post('/reservas/{reserva}/cancel', [ReservaController::class, 'cancel'])->name('propietario.reservas.cancel');
        // Clientes
        Route::get('/clientes', [\App\Http\Controllers\Propietario\ClienteController::class, 'index'])->name('propietario.clientes.index');
        Route::get('/clientes/{cliente}', [\App\Http\Controllers\Propietario\ClienteController::class, 'show'])->name('propietario.clientes.show');
        Route::post('/clientes/{cliente}/block', [\App\Http\Controllers\Propietario\ClienteController::class, 'block'])->name('propietario.clientes.block');
        Route::post('/clientes/{cliente}/unblock', [\App\Http\Controllers\Propietario\ClienteController::class, 'unblock'])->name('propietario.clientes.unblock');
    });

Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    });

Route::middleware(['auth'])->group(function () {
    Route::get('invitations/{invitation}/accept', [TeamInvitationController::class, 'accept'])->name('invitations.accept');
});

require __DIR__.'/settings.php';
