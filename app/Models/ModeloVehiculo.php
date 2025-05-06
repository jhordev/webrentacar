<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloVehiculo extends Model
{
    use HasFactory;
    protected $table = 'modelo_vehiculo';
    protected $fillable = ['marca_id', 'modelo'];

    public function marcaVehiculo()
    {
        return $this->belongsTo(MarcaVehiculo::class, 'marca_id');
    }

    public function detalleVehiculo()
    {
        return $this->hasMany(DetalleVehiculo::class, 'modelo_id');
    }


}
