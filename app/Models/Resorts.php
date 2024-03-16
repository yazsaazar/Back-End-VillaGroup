<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resorts extends Model
{
    protected $table = 'resorts';
    public $timestamps = false;
    protected $fillable = ['nombre', 'imagen']; 
}
