<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Concerns\HasTeams;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

#[Fillable(['name', 'email', 'password', 'current_team_id', 'role_id'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasTeams, Notifiable, TwoFactorAuthenticatable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function centros(): BelongsToMany
    {
        return $this->belongsToMany(CentroDeportivo::class, 'centro_user')
            ->withPivot('rol_en_centro')
            ->withTimestamps();
    }

    public function centroDeportivo(): HasOne
    {
        return $this->hasOne(CentroDeportivo::class);
    }

    public function isAdmin(): bool
    {
        return $this->role?->nombre === 'admin';
    }

    public function isPropietario(): bool
    {
        return $this->role?->nombre === 'propietario';
    }

    public function isCliente(): bool
    {
        return $this->role?->nombre === 'cliente';
    }
    public function delete()
    {
        $this->status = 'inactive';
        return $this->save();
    }
}
