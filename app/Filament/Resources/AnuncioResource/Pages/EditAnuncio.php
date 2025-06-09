<?php

namespace App\Filament\Resources\AnuncioResource\Pages;

use App\Filament\Resources\AnuncioResource;
use App\Models\FotoAnuncio;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditAnuncio extends EditRecord
{
    protected static string $resource = AnuncioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function update(): void
    {
        $data = $this->form->getState();

        // Actualizar el anuncio base
        $this->record->update($data);

        // Fotos - manejar orden y sincronización
        $imagenes = $data['imagenes'] ?? [];

        // Guardar o actualizar orden
        foreach ($imagenes as $index => $path) {
            FotoAnuncio::updateOrCreate(
                ['anuncio_id' => $this->record->id, 'image' => $path],
                ['orden' => $index]
            );
        }

        // Eliminar fotos que ya no están
        FotoAnuncio::where('anuncio_id', $this->record->id)
            ->whereNotIn('image', $imagenes)
            ->delete();

        Notification::make()
            ->title('Anuncio actualizado correctamente')
            ->success()
            ->send();

        $this->redirect(AnuncioResource::getUrl('index'), navigate: true);
    }

    public function fillForm(): void
    {
        $record = $this->getRecord();

        $detalle = $record->detalleVehiculo;
        $fotosOrdenadas = $record->fotosAnuncio()
            ->orderBy('orden')
            ->pluck('image')
            ->toArray();

        $this->form->fill([
            ...$record->toArray(),
            'tipo_id' => $detalle?->tipo_id,
            'marca_temp' => $detalle?->modeloVehiculo?->marca_id,
            'modelo_id' => $detalle?->modelo_id,
            'anio' => $detalle?->anio,
            'combustible' => $detalle?->combustible,
            'motor' => $detalle?->motor,
            'color' => $detalle?->color,
            'kilometraje' => $detalle?->kilometraje,
            'condicion' => $detalle?->condicion,
            'vestidura' => $detalle?->vestidura,
            'num_puerta' => $detalle?->num_puerta,
            'num_pasajero' => $detalle?->num_pasajero,
            'vidrios' => $detalle?->vidrios,
            'imagenes' => $fotosOrdenadas,
            'estado_temp' => $record->municipio?->estado_id,
        ]);
    }
}
