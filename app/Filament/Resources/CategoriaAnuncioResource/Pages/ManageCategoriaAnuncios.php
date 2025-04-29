<?php

namespace App\Filament\Resources\CategoriaAnuncioResource\Pages;

use App\Filament\Resources\CategoriaAnuncioResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCategoriaAnuncios extends ManageRecords
{
    protected static string $resource = CategoriaAnuncioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
