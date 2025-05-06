<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnuncioResource\Pages;
use App\Filament\Resources\AnuncioResource\RelationManagers;
use App\Models\Anuncio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Hidden;
use Illuminate\Support\HtmlString;
class AnuncioResource extends Resource
{
    protected static ?string $model = Anuncio::class;

    protected static ?string $label = 'Anuncio';
    protected static ?string $pluralLabel = 'Anuncios';
    protected static ?string $navigationGroup = 'Administrador de anuncios';

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Datos del vehiculo')
                        ->schema([

                        ]),
                    Step::make('Fotos del vehiculo')
                        ->schema([
                            // ...
                        ]),
                    Step::make('Datos del anuncio')
                        ->schema([
                            Hidden::make('num_anuncio')
                                ->disabled(),
                            TextInput::make('num_anuncio')
                                ->label('Número de Anuncio')
                                ->disabled()
                                ->dehydrated(false)
                                ->visibleOn('edit'),
                            Select::make('id_categoria')
                                ->label('Seleccione la categoría de anuncio')
                                ->relationship('categoria', 'nombre')
                                ->required()
                                ->reactive()
                                ->disabledOn('edit'),

                            Section::make('Información del anuncio')
                                ->columns(6)
                                ->schema([
                                    TextInput::make('titulo')->required()->columnSpanFull(),
                                    Textarea::make('descripcion')->required()->columnSpanFull(),
                                    Select::make('tipo')
                                        ->options([
                                            'premium' => 'Anuncio Premium',
                                            'standar' => 'Anuncio Standar',
                                        ])->columnSpan(2),
                                    TextInput::make('precio')->required()->numeric()->columnSpan(2),
                                    TextInput::make('link_video')->columnSpan(2),

                                    Select::make('estado_id')
                                        ->label('Estado')
                                        ->relationship('estadoUbicacion', 'nombre') // si tienes modelo Estado con campo 'nombre'
                                        ->required()
                                        ->reactive()
                                        ->afterStateUpdated(fn (Set $set) => $set('municipio_id', null))
                                        ->columnSpan(2),
                                    Select::make('municipio_id')
                                        ->label('Municipio')
                                        ->options(function (Get $get) {
                                            if (!$get('estado_id')) {
                                                return [];
                                            }
                                            return \App\Models\Municipio::where('estado_id', $get('estado_id'))
                                                ->pluck('nombre', 'id')
                                                ->toArray();
                                        })
                                        ->required()
                                        ->searchable()->columnSpan(2),
                                    Select::make('vendedor_id')
                                        ->label('Seleccione el vendedor de anuncio')
                                        ->relationship('vendedor', 'nombre')
                                        ->visible(fn (Forms\Get $get) =>
                                        in_array($get('id_categoria'), [
                                            1,
                                            2,
                                        ])
                                        )
                                        ->required()->columnSpan(2),
                                    Select::make('agencia_id')
                                        ->label('Seleccione la agencia de anuncio')
                                        ->relationship('agencia', 'nombre')
                                        ->visible(fn (Forms\Get $get) =>
                                            $get('id_categoria') == 3
                                        )
                                        ->required()->columnSpan(2),
                                    Toggle::make('estado')
                                        ->label('Estado')
                                        ->onColor('success')
                                        ->offColor('danger')
                                        ->visibleOn('edit')
                                ])
                        ])
                ])->columnSpanFull()->submitAction(new HtmlString('<button type="submit">Submit</button>'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('num_anuncio')->searchable()->sortable(),
                TextColumn::make('titulo')->searchable()->sortable(),
                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->color(fn ($state) => $state == 1 ? 'success' : 'danger')
                    ->formatStateUsing(fn ($state) => $state ? 'Activo' : 'Inactivo'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('estado')
                    ->label('Estado')
                    ->options([
                        1 => 'Activo',
                        0 => 'Inactivo',
                    ]),
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
            'index' => Pages\ListAnuncios::route('/'),
            'create' => Pages\CreateAnuncio::route('/create'),
            'edit' => Pages\EditAnuncio::route('/{record}/edit'),
        ];
    }
}
