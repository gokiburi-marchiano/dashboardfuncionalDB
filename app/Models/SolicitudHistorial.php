<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudHistorial extends Model
{
    use HasFactory;

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
