<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservaSlot extends Model
{
    protected $table = 'reserva_slots';

    public $timestamps = false;

    protected $fillable = [
        'reserva_id',
        'horario_slot_id',
    ];

    public function reserva(): BelongsTo
    {
        return $this->belongsTo(Reserva::class);
    }

    public function horarioSlot(): BelongsTo
    {
        return $this->belongsTo(HorarioSlot::class);
    }
}
