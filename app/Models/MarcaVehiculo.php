<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaVehiculo extends Model
{
    use HasFactory;
    protected $table = 'marca_vehiculo';

    protected $fillable = ['marca', 'tipo_vehiculo'];

    public function modeloVehiculo()
    {
        return $this->hasMany(ModeloVehiculo::class, 'marca_id');
    }

    public function getNombreCompletoAttribute()
    {
        return "{$this->marca} ({$this->tipo_vehiculo})";
    }

}
