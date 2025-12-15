<?php

namespace App\Filament\Widgets;

use App\Models\Anuncio;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class AnunciosPorMesChart extends ChartWidget
{
    protected static ?string $heading = 'Anuncios Publicados por Mes';
    
    protected static ?int $sort = 3;
    
    protected int | string | array $columnSpan = [
        'md' => 6,
        'lg' => 6,
        'xl' => 6,
    ];
    
    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        // Obtener los últimos 12 meses
        $data = Anuncio::select(
            DB::raw('DATE_FORMAT(fecha_publicacion, "%Y-%m") as mes'),
            DB::raw('COUNT(*) as total')
        )
        ->where('fecha_publicacion', '>=', now()->subMonths(12))
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();

        // Crear array de los últimos 12 meses
        $meses = [];
        $labels = [];
        for ($i = 11; $i >= 0; $i--) {
            $fecha = now()->subMonths($i);
            $mesKey = $fecha->format('Y-m');
            $meses[$mesKey] = 0;
            $labels[] = ucfirst($fecha->locale('es')->isoFormat('MMM YYYY'));
        }

        // Llenar con los datos reales
        foreach ($data as $item) {
            if (isset($meses[$item->mes])) {
                $meses[$item->mes] = $item->total;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Anuncios Publicados',
                    'data' => array_values($meses),
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
