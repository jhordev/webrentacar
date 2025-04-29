<?php

namespace App\Filament\Resources\AnuncioResource\Pages;

use App\Filament\Resources\AnuncioResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Anuncio;

class CreateAnuncio extends CreateRecord
{
    protected static string $resource = AnuncioResource::class;

}
