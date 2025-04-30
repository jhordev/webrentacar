<?php

namespace App\Filament\Resources\AgenciaResource\Pages;

use App\Filament\Resources\AgenciaResource;
use Filament\Actions;
use App\Models\Estado;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Resources\Pages\ListRecords;

class ListAgencias extends ListRecords
{
    protected static string $resource = AgenciaResource::class;

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
