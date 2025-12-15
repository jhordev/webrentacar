<?php

namespace App\Filament\Widgets;

use App\Models\Anuncio;
use Filament\Widgets\ChartWidget;

class AnunciosPorCategoriaChart extends ChartWidget
{
    protected static ?string $heading = 'Distribución de Anuncios por Categoría';
    
    protected static ?int $sort = 2;
    
    protected int | string | array $columnSpan = [
        'md' => 6,
        'lg' => 6,
        'xl' => 6,
    ];
    
    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $data = Anuncio::with('categoria')
            ->select('id_categoria', \DB::raw('COUNT(*) as total'))
            ->groupBy('id_categoria')
            ->get();

        $labels = [];
        $valores = [];
        $colores = [
            'rgb(59, 130, 246)',   // Azul
            'rgb(16, 185, 129)',   // Verde
            'rgb(245, 158, 11)',   // Amarillo
            'rgb(239, 68, 68)',    // Rojo
            'rgb(139, 92, 246)',   // Púrpura
            'rgb(236, 72, 153)',   // Rosa
            'rgb(20, 184, 166)',   // Teal
            'rgb(251, 146, 60)',   // Naranja
        ];

        foreach ($data as $index => $item) {
            $labels[] = $item->categoria ? $item->categoria->nombre : 'Sin Categoría';
            $valores[] = $item->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Anuncios',
                    'data' => $valores,
                    'backgroundColor' => array_slice($colores, 0, count($valores)),
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
