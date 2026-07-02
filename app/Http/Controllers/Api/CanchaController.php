<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cancha;
use App\Models\HorarioSlot;
use Illuminate\Http\Request;

class CanchaController extends Controller
{
    public function show($id)
    {
        $cancha = Cancha::with(['centroDeportivo', 'tipos', 'deportes'])
            ->findOrFail($id);

        return response()->json($cancha);
    }

    public function slots($id, Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
        ]);

        $slots = HorarioSlot::where('cancha_id', $id)
            ->where('fecha', $request->fecha)
            ->orderBy('hora_inicio')
            ->get();

        return response()->json($slots);
    }
}
