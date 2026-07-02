<?php

namespace App\Http\Controllers\Propietario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Propietario\StoreCentroRequest;
use App\Models\CentroDeportivo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CentroController extends Controller
{
    public function index(): Response
    {
        $user = Auth::user();

        $centros = CentroDeportivo::where('user_id', $user->id)
            ->withCount('canchas')
            ->get();

        return Inertia::render('Propietario/Centros/Index', [
            'centros' => $centros,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Propietario/Centros/Create');
    }

    public function store(StoreCentroRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $data = $request->validated();
        $data['user_id'] = $user->id;

        CentroDeportivo::create($data);

        return redirect()->route('propietario.centros.index')->with('success', 'Centro creado correctamente.');
    }

    public function edit(CentroDeportivo $centro): Response
    {
        $this->authorizeCentroOwner($centro);

        return Inertia::render('Propietario/Centros/Edit', [
            'centro' => $centro,
        ]);
    }

    public function update(StoreCentroRequest $request, CentroDeportivo $centro): RedirectResponse
    {
        $this->authorizeCentroOwner($centro);

        $centro->update($request->validated());

        return redirect()->route('propietario.centros.index')->with('success', 'Centro actualizado correctamente.');
    }

    public function destroy(CentroDeportivo $centro): RedirectResponse
    {
        $this->authorizeCentroOwner($centro);

        $centro->delete();

        return redirect()->route('propietario.centros.index')->with('success', 'Centro eliminado.');
    }

    protected function authorizeCentroOwner(CentroDeportivo $centro): void
    {
        $user = Auth::user();
        if ($centro->user_id !== $user->id) {
            abort(403);
        }
    }
}
