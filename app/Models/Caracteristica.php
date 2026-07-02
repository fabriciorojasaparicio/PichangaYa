<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $fillable = ['nombre', 'tipo', 'icono'];

    public function centrosDeportivos()
    {
        return $this->belongsToMany(CentroDeportivo::class, 'centro_caracteristica');
    }
}
