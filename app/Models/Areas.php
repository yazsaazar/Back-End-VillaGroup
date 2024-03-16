<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $fillable = ['nombre', 'id_departamento'];

    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'id_departamento');
    }
}
