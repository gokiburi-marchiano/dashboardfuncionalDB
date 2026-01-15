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
        'archivo_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
