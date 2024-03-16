<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resguardos extends Model
{
    protected $fillable = [
        'id_colaborador',
        'fecha',
        'id_resort',
        'id_area',
        'puesto',
        'id_equipo',
        'doc_firma',
    ];

    // Relaciones
    public function colaborador()
    {
        return $this->belongsTo(Colaboradores::class, 'id_colaborador');
    }

    public function resort()
    {
        return $this->belongsTo(Resorts::class, 'id_resort');
    }

    public function area()
    {
        return $this->belongsTo(Areas::class, 'id_area');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipos::class, 'id_equipo');
    }
}
