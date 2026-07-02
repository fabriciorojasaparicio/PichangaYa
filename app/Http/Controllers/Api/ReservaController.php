<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cancha;
use App\Models\HorarioSlot;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cancha_id' => 'required|exists:canchas,id',
            'slots' => 'required|array|min:1',
            'slots.*' => 'required|integer|exists:horario_slots,id',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Autenticación requerida para reservar.',
            ], 401);
        }

        $cancha = Cancha::findOrFail($request->cancha_id);
        $slotIds = array_unique($request->slots);

        if (count($slotIds) > $cancha->max_bloques_reserva) {
            return response()->json([
                'message' => sprintf('El máximo permitido para esta cancha es %d bloques.', $cancha->max_bloques_reserva),
            ], 422);
        }

        try {
            return DB::transaction(function () use ($slotIds, $cancha, $user) {
                $slots = HorarioSlot::whereIn('id', $slotIds)
                    ->where('cancha_id', $cancha->id)
                    ->lockForUpdate()
                    ->get();

                if ($slots->count() !== count($slotIds)) {
                    return response()->json([
                        'message' => 'Uno o más slots no existen o no pertenecen a esta cancha.',
                    ], 404);
                }

                if ($slots->pluck('estado')->contains(fn ($estado) => $estado !== 'libre')) {
                    return response()->json([
                        'message' => 'Uno o más slots ya no están disponibles.',
                    ], 409);
                }

                if ($slots->pluck('fecha')->unique()->count() > 1) {
                    return response()->json([
                        'message' => 'Todos los slots deben pertenecer a la misma fecha.',
                    ], 422);
                }

                $reserva = Reserva::create([
                    'user_id' => $user->id,
                    'cancha_id' => $cancha->id,
                    'fecha' => $slots->first()->fecha,
                    'estado' => 'confirmada',
                    'total' => $cancha->precio_por_bloque * $slots->count(),
                ]);

                $reserva->slots()->attach($slotIds);
                HorarioSlot::whereIn('id', $slotIds)->update(['estado' => 'reservado']);

                return response()->json([
                    'message' => 'Reserva creada correctamente.',
                    'data' => $reserva->load(['cancha.centroDeportivo', 'slots']),
                ], 201);
            });
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al procesar la reserva.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function disponibilidad($canchaId, Request $request)
    {
        $request->validate([
            'fecha' => ['required', 'date'],
        ]);

        $slots = HorarioSlot::where('cancha_id', $canchaId)
            ->where('fecha', $request->fecha)
            ->where('estado', 'libre')
            ->orderBy('hora_inicio')
            ->get();

        return response()->json($slots);
    }
}