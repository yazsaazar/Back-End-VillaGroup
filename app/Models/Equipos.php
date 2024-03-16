<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    protected $fillable = [
        'id_resort',
        'fecha_compra',
        'marca',
        'modelo',
        'numero_serie',
        'id_tipo',
        'especificaciones',
        'garantia',
        'etiqueta',
        'nota'
    ];

    protected $dates = ['fecha_compra'];

    public function resort()
    {
        return $this->belongsTo(Resorts::class, 'id_resort');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipos::class, 'id_tipo');
    }
}
