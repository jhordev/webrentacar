<?php

namespace App\Filament\Resources\AnuncioResource\Pages;

use App\Filament\Resources\AnuncioResource;
use App\Models\CategoriaAnuncio;
use Filament\Actions\Action;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use \App\Filament\Resources\CategoriaAnuncioResource;
class ListAnuncios extends ListRecords
{
    protected static string $resource = AnuncioResource::class;


    protected function getHeaderActions(): array
    {
        $noHayCategory = CategoriaAnuncio::count() === 0;

        if ($noHayCategory) {
            Notification::make()
                ->title('Primero crea una Categoría')
                ->danger()
                ->persistent()
                ->actions([
                    NotificationAction::make('categoria')
                        ->label('Ir a Categorías de anuncios')
                        ->url(CategoriaAnuncioResource::getUrl())
                        ->button(),
                ])
                ->send();
        }

        return [
            Action::make('create')
                ->label('Crear Anuncio')
                ->url(route('filament.admin.pages.crear-anuncio-wizard'))
                ->icon('heroicon-o-plus')
                ->visible(!$noHayCategory)
                ->button(),
        ];

    }
}
