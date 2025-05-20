<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoVehiculoResource\Pages;
use App\Filament\Resources\TipoVehiculoResource\RelationManagers;
use App\Models\TipoVehiculo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoVehiculoResource extends Resource
{
    protected static ?string $model = TipoVehiculo::class;

    protected static ?string $label = 'Tipo de Vehículo';
    protected static ?string $pluralLabel = 'Tipos de Vehículos';
    protected static ?string $navigationGroup = 'Gestión de Detalles Vehículos';

    protected static ?string $navigationIcon = 'heroicon-o-truck';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('vehiculo')
                    ->required()
                    ->placeholder('Selecciona un vehículo')
                    ->options([
                        'moto' => 'Moto',
                        'auto' => 'Auto',
                    ]),
                TextInput::make('tipo')->required()->placeholder('Ingresa el tipo de vehiculo'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial_number')
                    ->label('N°')
                    ->rowIndex(),
                TextColumn::make('tipo'),
                TextColumn::make('vehiculo'),
            ])
            ->filters([
                SelectFilter::make('vehiculo')
                    ->label('Selecciona un vehículo')
                    ->options([
                        'auto' => 'Auto',
                        'moto' => 'Moto',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('¿Estás seguro de eliminar este tipo de vehículo?')
                    ->modalDescription('Esta acción no se puede deshacer. Se eliminará el tipo de forma permanente.')
                    ->modalSubmitActionLabel('Sí, estoy seguro')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTipoVehiculos::route('/'),
        ];
    }
}
