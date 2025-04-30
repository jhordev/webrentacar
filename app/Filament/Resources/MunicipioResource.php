<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MunicipioResource\Pages;
use App\Filament\Resources\MunicipioResource\RelationManagers;
use App\Models\Estado;
use App\Models\Municipio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class MunicipioResource extends Resource
{
    protected static ?string $model = Municipio::class;

    protected static ?string $label = 'Municipio';
    protected static ?string $pluralLabel = 'Municipios';
    protected static ?string $navigationGroup = 'Ubigeo';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('estado_id')
                    ->label('Estado')
                    ->options(fn () => Estado::pluck('nombre', 'id')->toArray())
                    ->searchable()
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('nombre')
                    ->label('Nombre del Municipio')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'asc')
            ->columns([
                TextColumn::make('serial_number')
                    ->label('N°')
                    ->rowIndex(),
                TextColumn::make('nombre')->label('Nombre del Municipio')->searchable(),
                TextColumn::make('estado.nombre')->label('Estado'),
            ])
            ->filters([
                SelectFilter::make('estado_id')
                    ->label('Estado')
                    ->options(fn () => Estado::pluck('nombre', 'id')->toArray())
                    ->searchable()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('¿Estás seguro de eliminar este municipio?')
                    ->modalDescription('Esta acción no se puede deshacer. Se eliminará el municipio de forma permanente.')
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
            'index' => Pages\ManageMunicipios::route('/'),
        ];
    }
}
