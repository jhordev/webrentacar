<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use Filament\Actions;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PostResource\Widgets\StatsOverview;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        $noHayCategorias = Category::count() === 0;

        // Mostrar una notificación si no hay categorías
        if ($noHayCategorias) {
            Notification::make()
                ->title('Primero crea al menos una categoría')
                ->danger()
                ->persistent()
                ->actions([
                    NotificationAction::make('category')
                        ->label('Ir a Categorías')
                        ->url(CategoryResource::getUrl('index'))
                        ->button(),
                ])
                ->send();
        }

        return [
            Actions\CreateAction::make()
                ->visible(!$noHayCategorias),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }

}
