<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipos extends Model
{
    protected $table = 'tipos';
    public $timestamps = false;
    protected $fillable = ['nombre'];
}
