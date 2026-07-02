<?php

namespace App\Http\Controllers\Propietario;

use App\Http\Controllers\Controller;
use App\Models\CentroDeportivo;
use App\Models\Reserva;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ReservaController extends Controller
{
    public function index(Request $request): Response
    {
        $user = Auth::user();

        $query = Reserva::with('cancha.centroDeportivo', 'user')
            ->whereHas('cancha.centroDeportivo', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });

        if ($request->filled('fecha_desde')) {
            $query->where('fecha', '>=', $request->input('fecha_desde'));
        }

        if ($request->filled('fecha_hasta')) {
            $query->where('fecha', '<=', $request->input('fecha_hasta'));
        }

        if ($request->filled('centro_id')) {
            $query->whereHas('cancha.centroDeportivo', function ($q) use ($request) {
                $q->where('id', $request->input('centro_id'));
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->input('estado'));
        }

        $reservas = $query->orderByDesc('fecha')->get();

        $centros = CentroDeportivo::where('user_id', $user->id)->get();

        return Inertia::render('Propietario/Reservas/Index', [
            'reservas' => $reservas,
            'centros' => $centros,
            'filters' => $request->only(['fecha_desde', 'fecha_hasta', 'centro_id', 'estado']),
        ]);
    }

    public function confirm(Reserva $reserva): RedirectResponse
    {
        $this->authorizeReservaOwner($reserva);

        $reserva->estado = 'confirmada';
        $reserva->save();

        return redirect()->back()->with('success', 'Reserva confirmada.');
    }

    public function cancel(Reserva $reserva): RedirectResponse
    {
        $this->authorizeReservaOwner($reserva);

        $reserva->estado = 'cancelada';
        $reserva->save();

        return redirect()->back()->with('success', 'Reserva cancelada.');
    }

    protected function authorizeReservaOwner(Reserva $reserva): void
    {
        $user = Auth::user();
        if ($reserva->cancha->centroDeportivo->user_id !== $user->id) {
            abort(403);
        }
    }
}
