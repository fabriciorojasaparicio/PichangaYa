<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Deporte extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function canchas(): BelongsToMany
    {
        return $this->belongsToMany(Cancha::class, 'cancha_deporte');
    }
}
