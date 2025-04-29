<?php

namespace App\Filament\Resources\FaqPreguntaResource\Pages;

use App\Filament\Resources\FaqPreguntaResource;
use App\Models\FaqCategoria;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Resources\Pages\ManageRecords;

class ManageFaqPreguntas extends ManageRecords
{
    protected static string $resource = FaqPreguntaResource::class;

    protected function getHeaderActions(): array
    {
        $noHayCategorias = FaqCategoria::count() === 0;

        if ($noHayCategorias) {
            Notification::make()
                ->title('Primero crea una categoría')
                ->danger()
                ->persistent()
                ->actions([
                    NotificationAction::make('categorias')
                        ->label('Ir a Categorías')
                        ->url(route('filament.admin.resources.faq-categorias.index'))
                        ->button(),
                ])
                ->send();
        }

        return [
            Actions\CreateAction::make()
                ->visible(!$noHayCategorias),
        ];
    }
}
