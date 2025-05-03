<?php

namespace App\Filament\Resources\ContratoAgenciaResource\Pages;

use App\Filament\Resources\ContratoAgenciaResource;
use App\Models\Agencia;
use App\Models\Estado;
use Filament\Actions;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageContratoAgencias extends ManageRecords
{
    protected static string $resource = ContratoAgenciaResource::class;

    protected function getHeaderActions(): array
    {
        $noHayAgencias = Agencia::count() === 0;

        if ($noHayAgencias) {
            Notification::make()
                ->title('Primero crea al menos una agencia')
                ->danger()
                ->persistent()
                ->actions([
                    NotificationAction::make('agencia')
                        ->label('Ir a agencias')
                        ->url(route('filament.admin.resources.agencias.index'))
                        ->button(),
                ])
                ->send();
        }

        return [
            Actions\CreateAction::make()
                ->visible(!$noHayAgencias),
        ];
    }
}
