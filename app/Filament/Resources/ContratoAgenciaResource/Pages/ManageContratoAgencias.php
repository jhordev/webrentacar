<?php

namespace App\Filament\Resources\ContratoAgenciaResource\Pages;

use App\Filament\Resources\ContratoAgenciaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageContratoAgencias extends ManageRecords
{
    protected static string $resource = ContratoAgenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
