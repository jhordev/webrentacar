<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    use HasFactory;

    protected $table = 'tipo_vehiculo';

    protected $fillable = [
        'tipo',
        'vehiculo',
    ];

    public function detalles()
    {
        return $this->hasMany(DetallesVehiculo::class, 'tipo_id');
    }

}
