<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanAnuncio extends Model
{
    protected $table = 'planes_anuncios';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'destacado',
        'beneficios',
    ];
}
