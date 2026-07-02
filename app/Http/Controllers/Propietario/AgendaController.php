<?php

namespace App\Http\Controllers\Propietario;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AgendaController extends Controller
{
    public function agenda(): Response
    {
        $user = Auth::user();

        $reservas = Reserva::with('cancha.centroDeportivo', 'user')
            ->whereHas('cancha.centroDeportivo', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('fecha', '>=', now()->toDateString())
            ->orderBy('fecha', 'asc')
            ->limit(20)
            ->get();

        return Inertia::render('Propietario/Agenda', [
            'reservas' => $reservas,
        ]);
    }
}
