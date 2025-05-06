<?php

namespace App\Filament\Resources\ModeloVehiculoResource\Pages;

use App\Filament\Resources\ModeloVehiculoResource;
use App\Models\MarcaVehiculo;
use Filament\Actions;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListModeloVehiculos extends ListRecords
{
    protected static string $resource = ModeloVehiculoResource::class;

    protected function getHeaderActions(): array
    {
        $noHayMarcas = MarcaVehiculo::count() === 0;

        if ($noHayMarcas) {
            Notification::make()
                ->title('Primero crea al menos una marca')
                ->danger()
                ->persistent()
                ->actions([
                    NotificationAction::make('marca')
                        ->label('Crear una Marca')
                        ->url(route('filament.admin.resources.marca-vehiculos.index'))
                        ->button(),
                ])
                ->send();
        }

        return [
            Actions\CreateAction::make()
                ->visible(!$noHayMarcas),
        ];
    }
}
