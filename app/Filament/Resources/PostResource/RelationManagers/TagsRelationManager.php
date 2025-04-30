<?php

namespace App\Filament\Resources\PostResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;

class TagsRelationManager extends RelationManager
{
    protected static string $relationship = 'Tags';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->placeholder('Escribe el nombre...')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required(),

                        TextInput::make('slug')
                            ->label('Slug (automático)')
                            ->placeholder('Se genera a partir del nombre')
                            ->required(),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('serial_number')
                    ->label('N°')
                    ->rowIndex(),
                TextColumn::make('name')->limit('50')->sortable()->searchable()->label('Nombre'),
                TextColumn::make('slug')->limit('50'),
                TextColumn::make('created_at')->label('Fecha de creación')->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Crear nuevo tag'),
                AttachAction::make()
                    ->label('Vincular tag')
                    ->form([
                        Forms\Components\Select::make('recordId')
                            ->label('Selecciona un tag')
                            ->placeholder('Buscar o seleccionar una etiqueta...')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->options(function () {
                                // ID de tags ya vinculados al post actual
                                $tagsYaVinculados = $this->getOwnerRecord()
                                    ->tags()
                                    ->pluck('tags.id')
                                    ->toArray();

                                // Solo muestra los tags que aún no están vinculados
                                return \App\Models\Tag::whereNotIn('id', $tagsYaVinculados)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            }),
                    ])
            ])
            ->actions([
                DetachAction::make()->label('Quitar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
