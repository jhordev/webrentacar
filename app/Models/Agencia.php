<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agencia extends Model
{
    use HasFactory;
    protected $table = 'agencia';

    protected $guarded = [];


    public function contratos()
    {
        return $this->hasMany(ContratoAgencia::class, 'agencia_id');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }


    protected static function boot() // Función para eliminar las imagenes
    {
        parent::boot();
        static::deleting(function ($agencia) {
            if ($agencia->logo) {
                \Storage::disk('public')->delete($agencia->logo);
            }
            if ($agencia->banner) {
                \Storage::disk('public')->delete($agencia->banner);
            }
        });
    }
}
