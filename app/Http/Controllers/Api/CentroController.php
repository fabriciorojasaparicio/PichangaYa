<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CentroDeportivo;
use Illuminate\Http\Request;

class CentroController extends Controller
{
    public function index()
    {
        $centros = CentroDeportivo::with(['canchas', 'region', 'ciudad', 'distrito'])
            ->whereHas('canchas', function ($query) {
                $query->where('activo', true);
            })
            ->get();

        return response()->json($centros);
    }

    public function show($id)
    {
        $centro = CentroDeportivo::with([
            'canchas.deportes',
            'region',
            'ciudad',
            'distrito',
            'caracteristicas',
        ])->findOrFail($id);

        return response()->json($centro);
    }
}
