<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'rut', 'password'];

    protected $hidden = ['password', 'remember_token'];

    // ESTO ES VITAL: Laravel usa 'rut' para buscar el nombre de la columna
    public function getAuthIdentifierName()
    {
        return 'rut';
    }

    // ESTO ES NUEVO: Asegura que el valor del RUT sea lo que se guarde en la sesión
    public function getAuthIdentifier()
    {
        return $this->attributes['rut'];
    }

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    // Limpia el RUT antes de guardar para que no haya choques de formato
    public function setRutAttribute($value)
    {
        $this->attributes['rut'] = str_replace(['.', ' '], '', $value);
    }
}
