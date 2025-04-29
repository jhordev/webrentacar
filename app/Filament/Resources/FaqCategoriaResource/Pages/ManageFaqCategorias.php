<?php

namespace App\Filament\Resources\FaqCategoriaResource\Pages;

use App\Filament\Resources\FaqCategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFaqCategorias extends ManageRecords
{
    protected static string $resource = FaqCategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
