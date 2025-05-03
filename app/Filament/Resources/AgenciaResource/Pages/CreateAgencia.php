<?php

namespace App\Filament\Resources\AgenciaResource\Pages;

use App\Filament\Resources\AgenciaResource;
use App\Models\Estado;
use Filament\Actions;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateAgencia extends CreateRecord
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
