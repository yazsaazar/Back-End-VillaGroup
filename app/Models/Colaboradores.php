<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaboradores extends Model
{
    protected $table = 'colaboradores';

    protected $fillable = [
        'numero_colaborador',
        'nombre',
        'apellidos',
        'puesto',
        'id_area',
        'id_resort',
        'nota',
        'estado',
    ];

    protected $casts = [
        'estadi' => 'string', // Esto asegura que el estado sea tratada como string
    ];

    // Relación con el modelo Areas
    public function area()
    {
        return $this->belongsTo(Areas::class, 'id_area');
    }

    // Relación con el modelo Resorts
    public function resort()
    {
        return $this->belongsTo(Resorts::class, 'id_resort');
    }
}
