<?php

namespace App\Filament\Resources\MunicipioResource\Pages;

use App\Filament\Resources\MunicipioResource;
use App\Models\Estado;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMunicipios extends ManageRecords
{
    protected static string $resource = MunicipioResource::class;

    protected function getHeaderActions(): array
    {
        $noHayEstados = Estado::count() === 0;

        if ($noHayEstados) {
            Notification::make()
                ->title('Primero crea un Estado')
                ->danger()
                ->persistent()
                ->actions([
                    NotificationAction::make('estado')
                        ->label('Ir a Estados')
                        ->url(route('filament.admin.resources.estados.index'))
                        ->button(),
                ])
                ->send();
        }

        return [
            Actions\CreateAction::make()
                ->visible(!$noHayEstados),
        ];
    }
}
