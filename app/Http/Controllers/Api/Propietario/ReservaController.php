<?php

namespace App\Http\Controllers\Api\Propietario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;

class ReservaController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Reserva::whereHas('cancha.centroDeportivo', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with('user', 'cancha.centroDeportivo');

        if ($request->filled('status')) {
            $query->where('estado', $request->status);
        }

        if ($request->filled('from')) {
            $query->whereDate('fecha', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('fecha', '<=', $request->to);
        }

        $reservas = $query->get();

        return response()->json(['data' => $reservas]);
    }

    public function confirm(Request $request, Reserva $reserva)
    {
        $this->authorizeReserva($request->user(), $reserva);

        $reserva->estado = 'confirmado';
        $reserva->save();

        return response()->json(['message' => 'confirmed', 'data' => $reserva]);
    }

    public function cancel(Request $request, Reserva $reserva)
    {
        $this->authorizeReserva($request->user(), $reserva);

        $reserva->estado = 'cancelado';
        $reserva->save();

        return response()->json(['message' => 'cancelled', 'data' => $reserva]);
    }

    protected function authorizeReserva($owner, $reserva)
    {
        if (! $reserva->cancha || ! $reserva->cancha->centroDeportivo || $reserva->cancha->centroDeportivo->user_id != $owner->id) {
            abort(403);
        }
    }
}
