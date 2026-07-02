<?php

namespace App\Http\Controllers\Propietario;

use App\Http\Controllers\Controller;
use App\Models\Cancha;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\Propietario\StoreCanchaRequest;
use App\Models\CentroDeportivo;
use Illuminate\Http\RedirectResponse;

class CanchaController extends Controller
{
    public function index(): Response
    {
        $user = Auth::user();

        $canchas = Cancha::with('centroDeportivo')
            ->whereHas('centroDeportivo', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        return Inertia::render('Propietario/Canchas/Index', [
            'canchas' => $canchas,
        ]);
    }

    public function create(): Response
    {
        $user = Auth::user();
        $centros = CentroDeportivo::where('user_id', $user->id)->get();

        return Inertia::render('Propietario/Canchas/Create', [
            'centros' => $centros,
        ]);
    }

    public function store(StoreCanchaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Cancha::create($data);

        return redirect()->route('propietario.canchas.index')->with('success', 'Cancha creada.');
    }

    public function edit(Cancha $cancha): Response
    {
        $this->authorizeCanchaOwner($cancha);
        $user = Auth::user();
        $centros = CentroDeportivo::where('user_id', $user->id)->get();

        return Inertia::render('Propietario/Canchas/Edit', [
            'cancha' => $cancha,
            'centros' => $centros,
        ]);
    }

    public function update(StoreCanchaRequest $request, Cancha $cancha): RedirectResponse
    {
        $this->authorizeCanchaOwner($cancha);

        $cancha->update($request->validated());

        return redirect()->route('propietario.canchas.index')->with('success', 'Cancha actualizada.');
    }

    public function destroy(Cancha $cancha): RedirectResponse
    {
        $this->authorizeCanchaOwner($cancha);
        $cancha->delete();

        return redirect()->route('propietario.canchas.index')->with('success', 'Cancha eliminada.');
    }

    protected function authorizeCanchaOwner(Cancha $cancha): void
    {
        $user = Auth::user();
        if ($cancha->centroDeportivo->user_id !== $user->id) {
            abort(403);
        }
    }
}
