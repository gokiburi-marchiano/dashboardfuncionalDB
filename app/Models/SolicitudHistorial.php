<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudHistorial extends Model
{
    use HasFactory;

    // Asegúrate de que tu tabla en la base de datos se llame así
    // (Si en la migración usaste otro nombre, cámbialo aquí)
    protected $table = 'solicitud_historials';

    protected $fillable = [
        'solicitud_id',
        'user_id',
        'accion',
        'archivo_anterior',
        'archivo_nuevo',
        'motivo',
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
