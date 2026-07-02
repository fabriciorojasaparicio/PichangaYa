<?php

namespace App\Http\Controllers\Propietario;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ReporteController extends Controller
{
    public function index(): Response
    {
        $user = Auth::user();

        $reservasQuery = Reserva::whereHas('cancha.centroDeportivo', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });

        $totalReservas = (clone $reservasQuery)->count();
        $totalIngresos = (clone $reservasQuery)->sum('total');
        $estadoResumen = (clone $reservasQuery)
            ->selectRaw('estado, count(*) as total')
            ->groupBy('estado')
            ->get();

        $ingresosPorCentro = Reserva::selectRaw('centros_deportivos.nombre as centro, sum(reservas.total) as ingresos')
            ->join('canchas', 'reservas.cancha_id', 'canchas.id')
            ->join('centros_deportivos', 'canchas.centro_deportivo_id', 'centros_deportivos.id')
            ->where('centros_deportivos.user_id', $user->id)
            ->groupBy('centros_deportivos.nombre')
            ->get();

        return Inertia::render('Propietario/Reportes/Index', [
            'totalReservas' => $totalReservas,
            'totalIngresos' => $totalIngresos,
            'estadoResumen' => $estadoResumen,
            'ingresosPorCentro' => $ingresosPorCentro,
        ]);
    }
}
