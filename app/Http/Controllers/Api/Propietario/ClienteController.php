<?php

namespace App\Http\Controllers\Api\Propietario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reserva;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $clientes = User::whereHas('reservas', function ($q) use ($user) {
            $q->whereHas('cancha.centroDeportivo', function ($q2) use ($user) {
                $q2->where('user_id', $user->id);
            });
        })->withCount('reservas')->get();

        return response()->json(['data' => $clientes]);
    }

    public function show(Request $request, User $cliente)
    {
        $this->authorizeAccess($request->user(), $cliente);

        $reservas = Reserva::where('user_id', $cliente->id)
            ->whereHas('cancha.centroDeportivo', function ($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            })->with('cancha.centroDeportivo')->get();

        return response()->json(['data' => $cliente, 'reservas' => $reservas]);
    }

    public function block(Request $request, User $cliente)
    {
        $this->authorizeAccess($request->user(), $cliente);

        $cliente->status = 'inactive';
        $cliente->save();

        return response()->json(['message' => 'blocked', 'data' => $cliente]);
    }

    public function unblock(Request $request, User $cliente)
    {
        $this->authorizeAccess($request->user(), $cliente);

        $cliente->status = 'active';
        $cliente->save();

        return response()->json(['message' => 'unblocked', 'data' => $cliente]);
    }

    protected function authorizeAccess($owner, $cliente)
    {
        $exists = Reserva::where('user_id', $cliente->id)
            ->whereHas('cancha.centroDeportivo', function ($q) use ($owner) {
                $q->where('user_id', $owner->id);
            })->exists();

        if (! $exists) {
            abort(403);
        }
    }
}
