<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqCategoriaResource\Pages;
use App\Filament\Resources\FaqCategoriaResource\RelationManagers;
use App\Models\FaqCategoria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class FaqCategoriaResource extends Resource
{
    protected static ?string $model = FaqCategoria::class;
    protected static ?string $label = 'Categoría';
    protected static ?string $pluralLabel = 'Categorías';
    protected static ?string $navigationGroup = 'FAQ';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->label('Nombre de la Categoría')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->unique(ignoreRecord: true)
                    ->placeholder('Ingrese el nombre de la categoría'),
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
                TextColumn::make('nombre')->label('Nombre de categoría'),
                TextColumn::make('created_at')->label('Fecha de Creación'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('¿Estas seguro de eliminar esta categoria?')
                    ->modalDescription('Eliminar la categoría también eliminará todas las preguntas relacionadas con ella. Esta acción no se puede deshacer.')
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
            'index' => Pages\ManageFaqCategorias::route('/'),
        ];
    }
}
