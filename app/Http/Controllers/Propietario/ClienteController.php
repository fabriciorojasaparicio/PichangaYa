<?php

namespace App\Http\Controllers\Propietario;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ClienteController extends Controller
{
    public function index(): Response
    {
        $user = Auth::user();

        // Clientes que tienen reservas en centros del propietario
        $clientes = User::whereHas('reservas.cancha.centroDeportivo', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['reservas' => function ($q) use ($user) {
            $q->whereHas('cancha.centroDeportivo', function ($qc) use ($user) {
                $qc->where('user_id', $user->id);
            })->orderByDesc('fecha');
        }])->get();

        return Inertia::render('Propietario/Clientes/Index', [
            'clientes' => $clientes,
        ]);
    }

    public function show(User $cliente): Response
    {
        $this->authorizeClienteOwner($cliente);

        $reservas = Reserva::with('cancha.centroDeportivo')
            ->where('user_id', $cliente->id)
            ->whereHas('cancha.centroDeportivo', function ($q) {
                // no filter here; authorization ensures owner
            })->orderByDesc('fecha')->get();

        return Inertia::render('Propietario/Clientes/Show', [
            'cliente' => $cliente,
            'reservas' => $reservas,
        ]);
    }

    public function block(User $cliente): RedirectResponse
    {
        $this->authorizeClienteOwner($cliente);

        $cliente->status = 'inactive';
        $cliente->save();

        return redirect()->back()->with('success', 'Cliente bloqueado.');
    }

    public function unblock(User $cliente): RedirectResponse
    {
        $this->authorizeClienteOwner($cliente);

        $cliente->status = 'active';
        $cliente->save();

        return redirect()->back()->with('success', 'Cliente desbloqueado.');
    }

    protected function authorizeClienteOwner(User $cliente): void
    {
        $user = Auth::user();
        $has = Reserva::where('user_id', $cliente->id)
            ->whereHas('cancha.centroDeportivo', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->exists();

        if (! $has) abort(403);
    }
}
