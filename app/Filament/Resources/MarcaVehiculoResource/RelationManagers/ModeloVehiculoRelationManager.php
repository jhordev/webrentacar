<?php

namespace App\Filament\Resources\MarcaVehiculoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModeloVehiculoRelationManager extends RelationManager
{
    protected static string $relationship = 'modeloVehiculo';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('modelo')
                    ->required()
                    ->maxLength(255)->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('modelo')
            ->columns([
                TextColumn::make('serial_number')
                    ->label('N°')
                    ->rowIndex(),
                TextColumn::make('modelo')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('¿Estás seguro de eliminar este modelo?')
                    ->modalDescription('Esta acción no se puede deshacer. Se eliminará el modelo de forma permanente.')
                    ->modalSubmitActionLabel('Sí, estoy seguro')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
