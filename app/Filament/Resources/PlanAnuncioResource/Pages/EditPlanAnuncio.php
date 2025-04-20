<?php

namespace App\Filament\Resources\PlanAnuncioResource\Pages;

use App\Filament\Resources\PlanAnuncioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlanAnuncio extends EditRecord
{
    protected static string $resource = PlanAnuncioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
