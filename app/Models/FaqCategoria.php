<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategoria extends Model
{
    use HasFactory;

    protected $table = 'faq_categorias';

    protected $fillable = [
        'nombre',
    ];

    public function preguntas()
    {
        return $this->hasMany(FaqPregunta::class, 'categoria_id');
    }

}
