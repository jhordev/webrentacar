<?php

namespace App\Filament\Resources\ModeloVehiculoResource\Pages;

use App\Filament\Resources\ModeloVehiculoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModeloVehiculo extends EditRecord
{
    protected static string $resource = ModeloVehiculoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
