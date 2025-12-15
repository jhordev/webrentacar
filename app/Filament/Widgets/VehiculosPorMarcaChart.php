<?php

namespace App\Filament\Widgets;

use App\Models\DetalleVehiculo;
use Filament\Widgets\ChartWidget;

class VehiculosPorMarcaChart extends ChartWidget
{
    protected static ?string $heading = 'Top 10 Marcas Más Anunciadas';
    
    protected static ?int $sort = 4;
    
    protected int | string | array $columnSpan = [
        'md' => 6,
        'lg' => 6,
        'xl' => 6,
    ];
    
    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        // Obtener las marcas contando a través de modelo_vehiculo
        $data = DetalleVehiculo::with('modeloVehiculo.marca')
            ->select('modelo_id', \DB::raw('COUNT(*) as total'))
            ->groupBy('modelo_id')
            ->get()
            ->groupBy(function($item) {
                return $item->modeloVehiculo && $item->modeloVehiculo->marca 
                    ? $item->modeloVehiculo->marca->id 
                    : 0;
            })
            ->map(function($items) {
                return [
                    'marca' => $items->first()->modeloVehiculo && $items->first()->modeloVehiculo->marca 
                        ? $items->first()->modeloVehiculo->marca->marca 
                        : 'Sin Marca',
                    'total' => $items->sum('total')
                ];
            })
            ->sortByDesc('total')
            ->take(10);

        $labels = [];
        $valores = [];

        foreach ($data as $item) {
            $labels[] = $item['marca'];
            $valores[] = $item['total'];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Cantidad de Vehículos',
                    'data' => $valores,
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(236, 72, 153, 0.8)',
                        'rgba(20, 184, 166, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                        'rgba(168, 85, 247, 0.8)',
                        'rgba(34, 197, 94, 0.8)',
                    ],
                    'borderColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(245, 158, 11)',
                        'rgb(239, 68, 68)',
                        'rgb(139, 92, 246)',
                        'rgb(236, 72, 153)',
                        'rgb(20, 184, 166)',
                        'rgb(251, 146, 60)',
                        'rgb(168, 85, 247)',
                        'rgb(34, 197, 94)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
