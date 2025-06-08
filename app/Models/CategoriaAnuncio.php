<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaAnuncio extends Model
{
    use HasFactory;
    protected $table = 'categoria_anuncio';
    protected $fillable = ['id','nombre'];

    public function anuncios()
    {
        return $this->hasMany(Anuncio::class, 'id_categoria');
    }
}
