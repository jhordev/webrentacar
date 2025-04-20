<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigEmpresa extends Model
{
    use HasFactory;

    protected $table = 'config_empresa';

    protected $fillable = [
        'nombre',
        'logo',
        'direccion',
        'email',
        'telefono',
        'whatsapp',
        'sitio_web'
    ];

    public function redesSociales()
    {
        return $this->hasMany(EmpresaSocialMedia::class, 'empresa_id');
    }
}
