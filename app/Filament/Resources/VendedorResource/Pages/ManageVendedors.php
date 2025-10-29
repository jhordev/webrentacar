<?php

namespace App\Filament\Resources\VendedorResource\Pages;

use App\Filament\Resources\VendedorResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVendedors extends ManageRecords
{
    protected static string $resource = VendedorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['perfil']) && !empty($data['perfil'])) {
            // Remover el directorio del path (vendedoresperfil/)
            $data['perfil'] = str_replace('vendedoresperfil/', '', $data['perfil']);
        }
        return $data;
    }
}
