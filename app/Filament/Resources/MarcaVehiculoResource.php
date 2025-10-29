<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarcaVehiculoResource\Pages;
use App\Filament\Resources\MarcaVehiculoResource\RelationManagers;
use App\Models\MarcaVehiculo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Exception;

class MarcaVehiculoResource extends Resource
{
    protected static ?string $model = MarcaVehiculo::class;

    protected static ?string $label = 'Marca';
    protected static ?string $pluralLabel = 'Marcas';
    protected static ?string $navigationGroup = 'Gestión de Marcas';

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tipo_vehiculo')
                    ->label('Tipo de vehículo')
                    ->options([
                        'auto' => 'Auto',
                        'moto' => 'Moto',
                    ])
                    ->default('auto')
                    ->required()
                    ->native(false),

                TextInput::make('marca')->required()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial_number')
                    ->label('N°')
                    ->rowIndex(),
                TextColumn::make('marca'),
                TextColumn::make('tipo_vehiculo'),
            ])
            ->filters([
                SelectFilter::make('tipo_vehiculo')
                    ->options([
                        'auto' => 'Auto',
                        'moto' => 'Moto',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->using(function ($record) {
                        if ($record->modeloVehiculo()->exists()) {
                            Notification::make()
                                ->title('Acción no permitida')
                                ->body('No se puede eliminar esta marca porque tiene modelos relacionados. Eliminalos primero')
                                ->danger()
                                ->send();

                            // Detenemos la acción sin lanzar excepción
                            return false;
                        }

                        $record->delete();
                        return $record;
                    })
                    ->modalHeading('¿Estás seguro de eliminar esta marca?')
                    ->modalDescription('Esta acción no se puede deshacer. Se eliminará la marca de forma permanente.')
                    ->modalSubmitActionLabel('Sí, estoy seguro')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ModeloVehiculoRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarcaVehiculos::route('/'),
            'create' => Pages\CreateMarcaVehiculo::route('/create'),
            'edit' => Pages\EditMarcaVehiculo::route('/{record}/edit'),
        ];
    }
}
