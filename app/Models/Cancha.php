<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cancha extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'centro_deportivo_id',
        'precio_por_bloque',
        'max_bloques_reserva',
        'activo',
    ];

    public function centroDeportivo(): BelongsTo
    {
        return $this->belongsTo(CentroDeportivo::class);
    }

    public function horarioConfigs(): HasMany
    {
        return $this->hasMany(HorarioConfig::class);
    }

    public function horarioSlots(): HasMany
    {
        return $this->hasMany(HorarioSlot::class);
    }

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }

    public function tipos(): BelongsToMany
    {
        return $this->belongsToMany(TipoCancha::class, 'cancha_tipo');
    }

    public function deportes(): BelongsToMany
    {
        return $this->belongsToMany(Deporte::class, 'cancha_deporte')
                    ->withPivot('precio_hora')
                    ->withTimestamps();
    }
}
