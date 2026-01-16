<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicituds';

    protected $fillable = [
        'user_id',
        'user_rut',
        'titulo',
        'tipo',
        'departamento',
        'descripcion',
        'estado',
        'observacion_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function historial()
    {
        return $this->hasMany(SolicitudHistorial::class)->orderBy('created_at', 'desc');
    }

    public function archivos()
    {
        return $this->hasMany(SolicitudArchivo::class);
    }
}
