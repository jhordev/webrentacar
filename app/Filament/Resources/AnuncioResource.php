<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnuncioResource\Pages;
use App\Models\Anuncio;
use App\Models\Estado;
use App\Models\MarcaVehiculo;
use App\Models\ModeloVehiculo;
use App\Models\DetalleVehiculo;
use App\Models\FotoAnuncio;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
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
use Filament\Forms\Components\Hidden;

class AnuncioResource extends Resource
{
    protected static ?string $model = Anuncio::class;

    protected static ?string $label = 'Anuncio';
    protected static ?string $pluralLabel = 'Anuncios';
    protected static ?string $navigationGroup = 'Administrador de anuncios';

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    public static function form(Form $form): Form
    {
        $actualization = function (Set $set, Get $get) {
            $marcaId = $get('marca_temp');
            $modeloId = $get('modelo_id');
            $anio = $get('anio');

            $modelo = $modeloId ? ModeloVehiculo::find($modeloId) : null;
            if ($modelo && $modelo->marca_id != $marcaId) {
                $set('modelo_id', null);
            }

            $marca = $marcaId ? MarcaVehiculo::find($marcaId)?->marca : null;
            $modeloNombre = $modeloId ? ModeloVehiculo::find($modeloId)?->modelo : null;

            if ($marca && $modeloNombre && $anio) {
                $set('titulo', "$marca $modeloNombre $anio");
            }
        };

        return $form
            ->schema([
                Section::make('Categoría del anuncio')
                    ->schema([
                        Select::make('id_categoria')
                            ->disabled()
                            ->label('Categoría del anuncio')
                            ->options(\App\Models\CategoriaAnuncio::pluck('nombre', 'id'))
                            ->reactive()
                            ->required()
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                $set('tipo_id', null);

                                $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
                                if ($categoria && $categoria->nombre === 'Motos Nuevas') {
                                    $set('condicion', 'nuevo');
                                } else {
                                    $set('condicion', null);
                                }
                            }),
                    ]),

                Section::make('Datos del anuncio')
                    ->columns(6)
                    ->schema([
                        TextInput::make('titulo')
                            ->required()
                            ->columnSpan(5),
                        Toggle::make('estado')
                            ->label('Estado')
                            ->visibleOn('edit')
                            ->columnSpan(1),
                        Textarea::make('descripcion')
                            ->required()
                            ->columnSpanFull(),

                        Select::make('tipo')
                            ->options([
                                'premium' => 'Anuncio Premium',
                                'standar' => 'Anuncio Standar',
                            ])->columnSpan(2),

                        Select::make('vendedor_id')
                            ->label('Seleccione el vendedor de anuncio')
                            ->relationship('vendedor', 'nombre')
                            ->visible(function (Forms\Get $get) {
                                $categoriaId = $get('id_categoria');
                                if (!$categoriaId) return false;

                                $categoria = \App\Models\CategoriaAnuncio::find($categoriaId);
                                return $categoria && in_array($categoria->nombre, ['Motos Usadas', 'Autos Usados']);
                            })
                            ->required()
                            ->columnSpan(2),

                        Select::make('agencia_id')
                            ->label('Seleccione la agencia de anuncio')
                            ->relationship('agencia', 'nombre')
                            ->visible(function (Forms\Get $get) {
                                $categoriaId = $get('id_categoria');
                                if (!$categoriaId) return false;

                                $categoria = \App\Models\CategoriaAnuncio::find($categoriaId);
                                return $categoria && in_array($categoria->nombre, ['Motos Nuevas', 'Autos Nuevos']);
                            })
                            ->required()
                            ->columnSpan(2),

                        Select::make('estado_temp')
                            ->label('Estado')
                            ->options(fn () => Estado::pluck('nombre', 'id')->toArray())
                            ->placeholder('Selecciona un estado')
                            ->reactive()
                            ->afterStateUpdated(fn (Set $set) => $set('municipio_id', null))
                            ->dehydrated(false)
                            ->columnSpan(2),

                        Select::make('municipio_id')
                            ->label('Municipio')
                            ->placeholder('Selecciona un municipio')
                            ->options(function (Get $get) {
                                $estadoId = $get('estado_temp');

                                if (!$estadoId) {
                                    return [];
                                }

                                return \App\Models\Municipio::where('estado_id', $estadoId)
                                    ->pluck('nombre', 'id')
                                    ->toArray();
                            })
                            ->required()
                            ->searchable()
                            ->reactive()
                            ->columnSpan(2),


                        TextInput::make('precio')
                            ->numeric()
                            ->required()
                            ->columnSpan(2),

                        TextInput::make('link_video')
                            ->columnSpan(2),

                    ]),

                Section::make('Detalles del vehículo')
                    ->columns(6)
                    ->schema([
                        Select::make('tipo_id')
                            ->label('Tipo de Vehículo')
                            ->options(fn () => \App\Models\TipoVehiculo::pluck('tipo', 'id'))
                            ->searchable()
                            ->required()
                            ->columnSpan(2),

                        Select::make('marca_temp')
                            ->label('Marca')
                            ->options(fn () => MarcaVehiculo::pluck('marca', 'id')->toArray())
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated($actualization)
                            ->dehydrated(false)
                            ->columnSpan(2),

                        Select::make('modelo_id')
                            ->label('Modelo')
                            ->options(fn (Get $get) => ModeloVehiculo::where('marca_id', $get('marca_temp'))->pluck('modelo', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated($actualization)
                            ->columnSpan(2),

                        TextInput::make('anio')
                            ->numeric()
                            ->required()
                            ->afterStateUpdated($actualization)
                            ->columnSpan(2),
                        TextInput::make('combustible')
                            ->required()
                            ->afterStateUpdated($actualization)
                            ->columnSpan(2),
                        TextInput::make('motor')
                            ->required()
                            ->afterStateUpdated($actualization)
                            ->columnSpan(2),
                        TextInput::make('color')
                            ->required()
                            ->afterStateUpdated($actualization)
                            ->columnSpan(2),
                        TextInput::make('kilometraje')
                            ->required()
                            ->afterStateUpdated($actualization)
                            ->columnSpan(2),

                        //Para Autos
                        TextInput::make('vestidura')
                            ->label('Vestidura')
                            ->required()
                            ->columnSpan(2)
                            ->visible(function (Get $get) {
                                $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
                                return $categoria && $categoria->nombre === 'Autos Usados';
                            }),

                        TextInput::make('num_puerta')
                            ->label('N° Puertas')
                            ->numeric()
                            ->required()
                            ->columnSpan(2)
                            ->visible(function (Get $get) {
                                $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
                                return $categoria && $categoria->nombre === 'Autos Usados';
                            }),

                        TextInput::make('num_pasajero')
                            ->label('N° Pasajeros')
                            ->numeric()
                            ->required()
                            ->columnSpan(2)
                            ->visible(function (Get $get) {
                                $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
                                return $categoria && $categoria->nombre === 'Autos Usados';
                            }),

                        Select::make('vidrios')
                            ->label('Vidrios')
                            ->options([
                                'manual' => 'Manual',
                                'electrico' => 'Eléctrico',
                            ])
                            ->required()
                            ->columnSpan(2)
                            ->visible(function (Get $get) {
                                $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
                                return $categoria && $categoria->nombre === 'Autos Usados';
                            }),


                        Select::make('condicion')
                            ->options([
                                'nuevo' => 'Nuevo',
                                'usado' => 'Usado',
                                'seminuevo' => 'Seminuevo'
                            ])
                            ->required()
                            ->columnSpan(2),
                    ]),

                Section::make('Fotos del vehículo')
                    ->schema([
                        FileUpload::make('imagenes')
                            ->label('Fotos del vehículo')
                            ->multiple()
                            ->image()
                            ->reorderable()
                            ->directory('anuncios/fotos')
                            ->preserveFilenames()
                            ->maxFiles(16)
                            ->required()
                            ->columnSpanFull(),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('num_anuncio')->searchable()->sortable(),
                TextColumn::make('titulo')->searchable()->sortable(),
                TextColumn::make('tipo')->searchable()->sortable(),
                TextColumn::make('vendedor.telefono')
                    ->label('Tel. Vendedor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('estado')
                    ->badge()
                    ->color(fn ($state) => $state == 1 ? 'success' : 'danger')
                    ->formatStateUsing(fn ($state) => $state ? 'Activo' : 'Inactivo'),
            ])
            ->filters([
                SelectFilter::make('tipo')
                    ->options([
                        'premium' => 'Premium',
                        'standar' => 'Estandar',
                    ]),
                SelectFilter::make('estado')
                    ->options([
                        '1' => 'Activo',
                        '0' => 'Inactivo',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnuncios::route('/'),
            'edit' => Pages\EditAnuncio::route('/{record}/edit'),
        ];
    }
}
