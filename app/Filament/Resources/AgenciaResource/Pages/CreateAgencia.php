<?php

namespace App\Filament\Resources\AgenciaResource\Pages;

use App\Filament\Resources\AgenciaResource;
use App\Models\Estado;
use Filament\Actions;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateAgencia extends CreateRecord
{
    protected static string $resource = AgenciaResource::class;
}
