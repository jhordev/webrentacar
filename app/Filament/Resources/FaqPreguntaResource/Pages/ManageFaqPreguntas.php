<?php

namespace App\Filament\Resources\FaqPreguntaResource\Pages;

use App\Filament\Resources\FaqPreguntaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFaqPreguntas extends ManageRecords
{
    protected static string $resource = FaqPreguntaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
