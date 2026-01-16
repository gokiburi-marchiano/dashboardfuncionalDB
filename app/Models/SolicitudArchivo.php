<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudArchivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'solicitud_id',
        'file_path',
        'original_name',
        'mime_type'
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}
