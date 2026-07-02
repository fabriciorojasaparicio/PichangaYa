<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CentroDeportivo extends Model
{
    use HasFactory;
    protected $table = 'centros_deportivos';

    protected $fillable = [
        'user_id',
        'nombre',
        'direccion',
        'region_id',
        'ciudad_id',
        'distrito_id',
        'latitud',
        'longitud',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function canchas(): HasMany
    {
        return $this->hasMany(Cancha::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'centro_user')
            ->withPivot('rol_en_centro')
            ->withTimestamps();
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function distrito(): BelongsTo
    {
        return $this->belongsTo(Distrito::class);
    }

    public function caracteristicas()
    {
        return $this->belongsToMany(Caracteristica::class, 'centro_caracteristica');
    }
}


