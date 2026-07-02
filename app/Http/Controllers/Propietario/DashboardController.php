<?php

namespace App\Http\Controllers\Propietario;

use App\Http\Controllers\Controller;
use App\Models\CentroDeportivo;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function dashboard(): Response
    {
        $user = Auth::user();

        $centros = CentroDeportivo::where('user_id', $user->id)
            ->withCount('canchas')
            ->get();

        $centrosCount = $centros->count();
        $canchasCount = $centros->sum('canchas_count');

        $reservasQuery = Reserva::whereHas('cancha.centroDeportivo', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });

        $reservasCount = (clone $reservasQuery)->count();
        $ingresos = (clone $reservasQuery)->sum('total');

        $recentReservas = (clone $reservasQuery)
            ->with('cancha.centroDeportivo', 'user')
            ->orderByDesc('fecha')
            ->limit(5)
            ->get();

        return Inertia::render('Propietario/Dashboard', [
            'metrics' => [
                'centros' => $centrosCount,
                'canchas' => $canchasCount,
                'reservas' => $reservasCount,
                'ingresos' => $ingresos,
            ],
            'recentReservas' => $recentReservas,
        ]);
    }
}
