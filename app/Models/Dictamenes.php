<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dictamenes extends Model
{
    protected $fillable = [
        'id_tipo',
        'id_equipo',
        'numero_inventario',
        'ubicacion',
        'adquisicion',
        'calificacion',
        'motivo',
        'img_etiqueta',
        'img_equipo',
        'doc_firma',
    ];

    // Relaciones
    public function tipo()
    {
        return $this->belongsTo(Tipos::class, 'id_tipo');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipos::class, 'id_equipo');
    }
}
