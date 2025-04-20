<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTag extends EditRecord
{
    protected static string $resource = TagResource::class;

    protected function beforeDelete(): void
    {
        if ($this->record->posts()->count() > 0) {
            Notification::make()
                ->title('Eliminación bloqueada')
                ->body('Este tag está vinculado a uno o más posts. Debes desasociarlo antes de eliminarlo.')
                ->danger()
                ->send();

            $this->halt(); // ❗ Detiene el proceso completamente
        }
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
