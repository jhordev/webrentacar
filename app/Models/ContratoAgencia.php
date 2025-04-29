<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoAgencia extends Model
{
    use HasFactory;


    protected $table = 'contratos_agencia';

    protected $fillable = [
        'agencia_id',
        'fecha_inicio',
        'fecha_fin',
        'archivo_contrato',
        'observaciones',
        'estado',
    ];

    protected $guarded = [];


    public function agencia()
    {
        return $this->belongsTo(Agencia::class, 'agencia_id');
    }
}
