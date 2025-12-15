<?php

namespace App\Filament\Widgets;

use App\Models\Agencia;
use App\Models\Anuncio;
use App\Models\ContratoAgencia;
use App\Models\Vendedor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Total de anuncios activos
        $anunciosActivos = Anuncio::where('estado', true)->count();
        
        // Total de anuncios publicados este mes
        $anunciosEsteMes = Anuncio::whereMonth('fecha_publicacion', now()->month)
            ->whereYear('fecha_publicacion', now()->year)
            ->count();
        
        // Total de agencias
        $totalAgencias = Agencia::count();
        
        // Total de vendedores
        $totalVendedores = Vendedor::count();
        
        // Contratos activos (estado = 1 o activo)
        $contratosActivos = ContratoAgencia::where('estado', 1)->count();

        return [
            Stat::make('Anuncios Activos', $anunciosActivos)
                ->description('Total de anuncios publicados')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
            
            Stat::make('Anuncios Este Mes', $anunciosEsteMes)
                ->description('Publicados en ' . now()->locale('es')->isoFormat('MMMM'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
            
            Stat::make('Agencias Registradas', $totalAgencias)
                ->description('Total de agencias en el sistema')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('warning'),
            
            Stat::make('Vendedores', $totalVendedores)
                ->description('Vendedores registrados')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
            
            Stat::make('Contratos Activos', $contratosActivos)
                ->description('Contratos vigentes')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
        ];
    }
}
