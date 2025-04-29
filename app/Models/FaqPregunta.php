<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class FaqPregunta extends Model
{
    use HasFactory;

    protected $table = 'faq_preguntas';

    protected $fillable = [
        'categoria_id',
        'pregunta',
        'respuesta',
        'estado'
    ];

    //Función para mapear y hacer 0 o 1 al estado activo e inactivo
    protected function estado(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value === 'activo',
            set: fn ($value) => $value ? 'activo' : 'inactivo',
        );
    }


    public function categoria(){
        return $this->belongsTo(FaqCategoria::class, 'categoria_id');
    }
}
