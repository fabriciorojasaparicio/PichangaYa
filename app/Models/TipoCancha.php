<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TipoCancha extends Model
{
    protected $table = 'tipos_cancha';

    protected $fillable = [
        'nombre',
    ];

    public function canchas(): BelongsToMany
    {
        return $this->belongsToMany(Cancha::class, 'cancha_tipo');
    }
}
