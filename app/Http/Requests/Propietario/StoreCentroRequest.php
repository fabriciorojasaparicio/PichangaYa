<?php

namespace App\Http\Requests\Propietario;

use Illuminate\Foundation\Http\FormRequest;

class StoreCentroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->isPropietario();
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:500'],
            'region_id' => ['nullable', 'exists:regiones,id'],
            'ciudad_id' => ['nullable', 'exists:ciudades,id'],
            'distrito_id' => ['nullable', 'exists:distritos,id'],
            'latitud' => ['nullable', 'numeric'],
            'longitud' => ['nullable', 'numeric'],
        ];
    }
}
