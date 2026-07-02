<?php

namespace App\Http\Requests\Propietario;

use App\Models\CentroDeportivo;
use Illuminate\Foundation\Http\FormRequest;

class StoreCanchaRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        if (! $user || ! $user->isPropietario()) return false;

        $centroId = $this->input('centro_deportivo_id');
        if ($centroId) {
            $centro = CentroDeportivo::find($centroId);
            if (! $centro || $centro->user_id !== $user->id) {
                return false;
            }
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'centro_deportivo_id' => ['required', 'exists:centros_deportivos,id'],
            'nombre' => ['required', 'string', 'max:255'],
            'precio_por_bloque' => ['required', 'numeric'],
            'max_bloques_reserva' => ['required', 'integer', 'min:1'],
            'activo' => ['sometimes', 'boolean'],
        ];
    }
}
