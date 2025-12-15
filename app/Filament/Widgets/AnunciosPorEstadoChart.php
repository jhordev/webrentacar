<?php

namespace App\Filament\Widgets;

use App\Models\Anuncio;
use Filament\Widgets\ChartWidget;

class AnunciosPorEstadoChart extends ChartWidget
{
    protected static ?string $heading = 'Estado de Anuncios';
    
    protected static ?int $sort = 5;
    
    protected int | string | array $columnSpan = [
        'md' => 6,
        'lg' => 6,
        'xl' => 6,
    ];
    
    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $activos = Anuncio::where('estado', true)->count();
        $inactivos = Anuncio::where('estado', false)->count();

        return [
            'datasets' => [
                [
                    'label' => 'Anuncios',
                    'data' => [$activos, $inactivos],
                    'backgroundColor' => [
                        'rgb(16, 185, 129)',  // Verde para activos
                        'rgb(239, 68, 68)',   // Rojo para inactivos
                    ],
                    'borderColor' => [
                        'rgb(5, 150, 105)',
                        'rgb(220, 38, 38)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['Activos', 'Inactivos'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
