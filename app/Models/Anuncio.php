<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;

    protected $table = 'anuncio';

    protected $fillable = [
        'id_categoria',
        'num_anuncio',
        'titulo',
        'descripcion',
        'tipo',
        'vendedor_id',
        'agencia_id',
        'precio',
        'estado_id',
        'municipio_id',
        'link_video',
        'fecha_publicacion',
        'estado',
    ];

    protected $casts = [
        'fecha_publicacion' => 'date',
        'estado' => 'boolean',
        'precio' => 'decimal:2',
    ];

    // Relaciones

    public function categoria()
    {
        return $this->belongsTo(CategoriaAnuncio::class, 'id_categoria');
    }

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'vendedor_id');
    }

    public function agencia()
    {
        return $this->belongsTo(Agencia::class, 'agencia_id');
    }

    public function estadoUbicacion()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function detalleVehiculo()
    {
        return $this->hasOne(DetalleVehiculo::class, 'anuncio_id');
    }

    public function fotosAnuncio()
    {
        return $this->hasMany(FotoAnuncio::class, 'anuncio_id');
    }
}
