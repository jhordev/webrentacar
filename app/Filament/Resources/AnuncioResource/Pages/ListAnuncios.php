<?php

namespace App\Filament\Resources\AnuncioResource\Pages;

use App\Filament\Resources\AnuncioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnuncios extends ListRecords
{
    protected static string $resource = AnuncioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
