<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaSocialMedia extends Model
{
    use HasFactory;

    protected $table = 'empresa_social_media';

    protected $fillable = [
        'empresa_id',
        'nombre_red',
        'url',
        'orden',
    ];

    public function empresa()
    {
        return $this->belongsTo(ConfigEmpresa::class, 'empresa_id');
    }
}
