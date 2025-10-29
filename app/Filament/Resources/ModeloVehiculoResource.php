<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModeloVehiculoResource\Pages;
use App\Filament\Resources\ModeloVehiculoResource\RelationManagers;
use App\Models\MarcaVehiculo;
use App\Models\ModeloVehiculo;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModeloVehiculoResource extends Resource
{
    protected static ?string $model = ModeloVehiculo::class;

    protected static ?string $label = 'Modelo';
    protected static ?string $pluralLabel = 'Modelos';
    protected static ?string $navigationGroup = 'Gestión de Marcas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('marca_id')
                    ->label('Marca de vehículo')
                    ->options(MarcaVehiculo::all()->pluck('nombre_completo', 'id'))
                    ->searchable()
                    ->required(),
                TextInput::make('modelo')->required()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial_number')
                    ->label('N°')
                    ->rowIndex(),
                TextColumn::make('modelo')->searchable(),
                TextColumn::make('marcaVehiculo.nombre_completo'),

            ])
            ->filters([
                SelectFilter::make('marca_id')
                    ->label('Filtrar por marca')
                    ->options(
                        MarcaVehiculo::whereHas('modeloVehiculo')
                            ->get()
                            ->mapWithKeys(fn ($marca) => [$marca->id => $marca->nombre_completo])
                            ->toArray()
                    )
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModeloVehiculos::route('/'),
            'create' => Pages\CreateModeloVehiculo::route('/create'),
            'edit' => Pages\EditModeloVehiculo::route('/{record}/edit'),
        ];
    }
}
