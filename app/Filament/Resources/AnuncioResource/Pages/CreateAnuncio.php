<?php

namespace App\Filament\Resources\AnuncioResource\Pages;

use App\Filament\Resources\AnuncioResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Anuncio;

class CreateAnuncio extends CreateRecord
{
    protected static string $resource = AnuncioResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['num_anuncio'] = $this->generateNumAnuncio($data['id_categoria']);

        return $data;
    }

    private function generateNumAnuncio($idCategoria)
    {
        $idCategoria = (int) $idCategoria; // fuerza a entero


        // Mapeo manual simple
        $bases = [
            1 => 2000000, // Motos Usadas
            2 => 1000000, // Autos Usados
            3 => 3000000, // Motos Nuevas
        ];

        $baseNumber = $bases[$idCategoria] ?? 4000000; // si no existe, 4000000



        $lastNum = Anuncio::where('id_categoria', $idCategoria)
            ->max('num_anuncio');


        return $lastNum ? $lastNum + 1 : $baseNumber;
    }
}
