<?php

namespace App\Filament\Resources\MarcaVehiculoResource\Pages;

use App\Filament\Resources\MarcaVehiculoResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditMarcaVehiculo extends EditRecord
{
    protected static string $resource = MarcaVehiculoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->using(function ($record) {
                    if ($record->modeloVehiculo()->exists()) {
                        Notification::make()
                            ->title('Acción no permitida')
                            ->body('No se puede eliminar esta marca porque tiene modelos relacionados. Eliminalos primero')
                            ->danger()
                            ->send();

                        // Detenemos la acción sin lanzar excepción
                        return false;
                    }

                    $record->delete();
                    return $record;
                })
                ->modalHeading('¿Estás seguro de eliminar esta marca?')
                ->modalDescription('Esta acción no se puede deshacer. Se eliminará la marca de forma permanente.')
                ->modalSubmitActionLabel('Sí, estoy seguro')

        ];
    }
}
