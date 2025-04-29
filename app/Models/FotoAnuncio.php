<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoAnuncio extends Model
{
    use HasFactory;

    protected $table = 'fotos_anuncios';

    protected $fillable = [
        'anuncio_id',
        'image',
        'orden',
    ];

    protected $casts = [
        'orden' => 'integer',
    ];

    // Relación: una foto pertenece a un anuncio
    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class, 'anuncio_id');
    }
}
