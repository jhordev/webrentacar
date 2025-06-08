<?php

namespace App\Filament\Resources\AnuncioResource\Pages;

use App\Filament\Resources\AnuncioResource;
use App\Models\FotoAnuncio;
use App\Models\DetalleVehiculo;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateAnuncio extends CreateRecord
{
    protected static string $resource = AnuncioResource::class;

    // Variables temporales
    protected array $imagenes = [];
    protected array $detalles = [];

    /**
     * Extraer datos antes de guardar el anuncio
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {

        Log::info('Datos antes de crear anuncio:', $data);
        // Guardar imágenes
        $this->imagenes = $data['imagenes'] ?? [];
        unset($data['imagenes']);

        // Generar número de anuncio automático
        $ultimo = \App\Models\Anuncio::max('num_anuncio');
        $data['num_anuncio'] = $ultimo ? $ultimo + 1 : 1000001;

        // Guardar detalles del vehículo
        $this->detalles = [
            'modelo_id'     => $data['modelo_id'] ?? null,
            'anio'          => $data['anio'] ?? null,
            'tipo_id'       => $data['tipo_id'] ?? null,
            'combustible'   => $data['combustible'] ?? null,
            'motor'         => $data['motor'] ?? null,
            'color'         => $data['Color'] ?? null,
            'vestidura'     => $data['Vestidura'] ?? null,
            'kilometraje'   => $data['kilometraje'] ?? null,
            'num_puerta'    => $data['num_puerta'] ?? null,
            'num_pasajero'  => $data['num_pasajero'] ?? null,
            'vidrios'       => $data['vidrios'] ?? null,
            'condicion'     => $data['condicion'] ?? null,
        ];

        if (
            isset($data['id_categoria']) &&
            \App\Models\CategoriaAnuncio::find($data['id_categoria'])?->nombre === 'Motos Nuevas'
        ) {
            $this->detalles['condicion'] = 'nuevo';
        }


        return $data;
    }


    /**
     * Insertar fotos y detalles del vehículo después de crear el anuncio
     */
    protected function afterCreate(): void
    {
        // Guardar fotos del anuncio
        foreach ($this->imagenes as $index => $ruta) {
            FotoAnuncio::create([
                'anuncio_id' => $this->record->id,
                'image' => $ruta,
                'orden' => $index + 1,
            ]);
        }

        // Guardar detalles del vehículo
        DetalleVehiculo::create(array_merge(
            $this->detalles,
            ['anuncio_id' => $this->record->id]
        ));
    }
}
