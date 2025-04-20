<?php

namespace App\Filament\Resources\PlanAnuncioResource\Pages;

use App\Filament\Resources\PlanAnuncioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlanAnuncios extends ListRecords
{
    protected static string $resource = PlanAnuncioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
