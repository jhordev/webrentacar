<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $table = 'vendedor';

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'whatsapp',
        'perfil',
    ];

    protected static function boot() // Función para eliminar las imagenes
    {
        parent::boot();
        static::deleting(function ($vendedor) {
            if ($vendedor->perfil) {
                \Storage::disk('public')->delete($vendedor->perfil);
            }
        });
    }
}
