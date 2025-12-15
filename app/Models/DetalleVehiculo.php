<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVehiculo extends Model
{
    use HasFactory;
    protected $table = 'detalles_vehiculo';

    protected $fillable = [
        'anuncio_id',
        'modelo_id',
        'anio',
        'tipo_id',
        'combustible',
        'motor',
        'color',
        'vestidura',
        'kilometraje',
        'num_puerta',
        'num_pasajero',
        'vidrios',
        'condicion'
    ];

    public function modeloVehiculo()
    {
        return $this->belongsTo(ModeloVehiculo::class, 'modelo_id');
    }

    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class, 'anuncio_id');
    }

    // Relación a través de modelo para acceder a la marca
    public function marca()
    {
        return $this->hasOneThrough(
            MarcaVehiculo::class,
            ModeloVehiculo::class,
            'id', // Foreign key on ModeloVehiculo table
            'id', // Foreign key on MarcaVehiculo table
            'modelo_id', // Local key on DetalleVehiculo table
            'marca_id' // Local key on ModeloVehiculo table
        );
    }
}
