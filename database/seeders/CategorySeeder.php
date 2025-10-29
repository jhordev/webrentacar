<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Noticias',
            'Guías y Consejos',
            'Mantenimiento',
            'Tendencias',
            'Lanzamientos',
            'Comparativas',
            'Seguridad',
            'Tecnología',
            'Finanzas y Seguros',
            'Eventos',
            'Opinión',
            'Destacados',
            'Estilo de Vida',
            'Novedades del Mercado',
            'Ofertas y Promociones',
        ];

        foreach ($categorias as $nombre) {
            Category::firstOrCreate(
                ['slug' => Str::slug($nombre, '-')],
                ['name' => $nombre]
            );
        }
    }
}
