<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqPreguntaResource\Pages;
use App\Filament\Resources\FaqPreguntaResource\RelationManagers;
use App\Models\FaqPregunta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class FaqPreguntaResource extends Resource
{
    protected static ?string $model = FaqPregunta::class;
    protected static ?string $label = 'Pregunta';
    protected static ?string $pluralLabel = 'Preguntas';
    protected static ?string $navigationGroup = 'FAQ';
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('categoria_id')
                    ->label('Categoría')
                    ->relationship('categoria', 'nombre')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('pregunta')
                    ->label('Pregunta')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ingrese su pregunta')
                    ->columnSpanFull(),

                Textarea::make('respuesta')
                    ->label('Respuesta')
                    ->required()
                    ->rows(5)
                    ->placeholder('Ingrese la respuesta de la pregunta')
                    ->columnSpanFull(),

                Toggle::make('estado')
                    ->label('Activo')
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(false)
                    ->required()
                    ->default(true)
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
                TextColumn::make('pregunta')
                ->searchable(),
                TextColumn::make('respuesta')
                ->limit(50),
                TextColumn::make('categoria.nombre'),
                Tables\Columns\IconColumn::make('estado')
                    ->label('Activo')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

            ])
            ->filters([
                SelectFilter::make('categoria_id')
                    ->label('Categoría')
                    ->relationship('categoria', 'nombre'),
                SelectFilter::make('estado')
                    ->options([
                        'activo' => 'Activo',
                        'inactivo' => 'Inactivo',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('¿Estás seguro de eliminar esta pregunta?')
                    ->modalDescription('Esta acción no se puede deshacer. Se eliminará la pregunta de forma permanente.')
                    ->modalSubmitActionLabel('Sí, estoy seguro'),
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
            'index' => Pages\ManageFaqPreguntas::route('/'),
        ];
    }
}
