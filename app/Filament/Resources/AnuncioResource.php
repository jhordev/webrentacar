<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnuncioResource\Pages;
use App\Filament\Resources\AnuncioResource\RelationManagers;
use App\Models\Anuncio;
use App\Models\Estado;
use App\Models\MarcaVehiculo;
use App\Models\ModeloVehiculo;
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
                Wizard::make([
                    Step::make('Categoría del anuncio')
                        ->schema([
                            Select::make('categoria_anuncio_id')
                                ->label('Categoría del anuncio')
                                ->options(\App\Models\CategoriaAnuncio::pluck('nombre', 'id'))
                                ->reactive()
                                ->required()
                                ->afterStateUpdated(function (Set $set, Get $get) {
                                    $set('tipo_id', null);

                                    $categoria = \App\Models\CategoriaAnuncio::find($get('categoria_anuncio_id'));
                                    if ($categoria && $categoria->nombre === 'Motos Nuevas') {
                                        $set('condicion', 'nuevo');
                                    } else {
                                        $set('condicion', null);
                                    }
                                }),
                        ]),
                    Step::make('Datos del vehiculo')
                        ->schema([
                            Section::make()->columns(6)->schema([
                                Select::make('tipo_id')
                                    ->label('Tipo de Vehículo')
                                    ->options(function (Get $get) {
                                        $categoriaId = $get('categoria_anuncio_id');
                                        if (!$categoriaId) return [];

                                        $categoria = \App\Models\CategoriaAnuncio::find($categoriaId);
                                        if (!$categoria) return [];

                                        $map = [
                                            'Motos Nuevas' => 'moto',
                                            'Motos Usadas' => 'moto',
                                            'Autos Nuevos' => 'auto',
                                            'Autos Usados' => 'auto',
                                        ];

                                        $vehiculo = $map[$categoria->nombre] ?? null;
                                        if (!$vehiculo) return [];

                                        return \App\Models\TipoVehiculo::where('vehiculo', $vehiculo)
                                            ->pluck('tipo', 'id');
                                    })
                                    ->searchable()
                                    ->required()
                                    ->columnSpan(2),
                                Select::make('marca_temp')
                                    ->label('Marca')
                                    ->placeholder('Selecciona una marca')
                                    ->options(function (Get $get) {
                                        $categoriaId = $get('categoria_anuncio_id');
                                        if (!$categoriaId) return [];

                                        // Validar existencia y que tenga campo 'nombre'
                                        $categoria = \App\Models\CategoriaAnuncio::find($categoriaId);
                                        if (!$categoria || !isset($categoria->nombre)) return [];

                                        $map = [
                                            'Motos Nuevas' => 'moto',
                                            'Motos Usadas' => 'moto',
                                            'Autos Nuevos' => 'auto',
                                            'Autos Usados' => 'auto',
                                        ];

                                        $tipoVehiculo = $map[$categoria->nombre] ?? null;
                                        if (!$tipoVehiculo) return [];

                                        return \App\Models\MarcaVehiculo::where('tipo_vehiculo', $tipoVehiculo)
                                            ->pluck('marca', 'id')
                                            ->toArray();
                                    })
                                    ->searchable()
                                    ->reactive()
                                    ->afterStateUpdated($actualization)
                                    ->dehydrated(false)
                                    ->columnSpan(2),

                                Select::make('modelo_id')
                                    ->label('Modelo')
                                    ->placeholder('Selecciona un modelo')
                                    ->options(function (Get $get) {
                                        if (!$get('marca_temp')) return [];

                                        return \App\Models\ModeloVehiculo::where('marca_id', $get('marca_temp'))
                                            ->pluck('modelo', 'id');
                                    })
                                    ->searchable()
                                    ->required()
                                    ->afterStateUpdated($actualization)
                                    ->reactive()
                                    ->columnSpan(2),

                                TextInput::make('anio')
                                    ->label('Año')
                                    ->placeholder('Ej: 2021')
                                    ->numeric()
                                    ->afterStateUpdated($actualization)
                                    ->required()
                                    ->columnSpan(2),
                                Select::make('combustible')
                                    ->label('Combustible')
                                    ->placeholder('Selecciona una opción')
                                    ->options(function (Get $get) {
                                        $categoria = \App\Models\CategoriaAnuncio::find($get('categoria_anuncio_id'));

                                        if ($categoria && $categoria->nombre === 'Autos Usados') {
                                            return [
                                                'gasolina' => 'Gasolina',
                                                'diesel' => 'Diesel',
                                                'electrico' => 'Eléctrico',
                                                'hidrico' => 'Hidrico',
                                            ];
                                        }

                                        return [
                                            'gasolina' => 'Gasolina',
                                            'electrico' => 'Eléctrico',
                                        ];
                                    })
                                    ->required()
                                    ->reactive()
                                    ->columnSpan(2),
                                TextInput::make('motor')
                                    ->label('Motor(Cilindros)')
                                    ->placeholder('Ej: 1.6')
                                    ->required()
                                    ->columnSpan(2),
                                TextInput::make('Color')
                                    ->label('Ingrese el color')
                                    ->required()
                                    ->columnSpan(2),
                                Select::make('Vestidura')
                                    ->label('Seleccione vestidura')
                                    ->placeholder('Seleccione Vestidura')
                                    ->options([
                                        'tela' => 'Tela',
                                        'piel' => 'Piel',
                                    ])
                                    ->required()
                                    ->columnSpan(2)
                                    ->visible(function (Get $get) {
                                        $categoria = \App\Models\CategoriaAnuncio::find($get('categoria_anuncio_id'));
                                        return $categoria && $categoria->nombre === 'Autos Usados';
                                    }),
                                TextInput::make('kilometraje')
                                    ->label('Kilometraje')
                                    ->placeholder('Ej: 100000')
                                    ->numeric()
                                    ->required()
                                    ->columnSpan(2),
                                TextInput::make('num_puerta')
                                    ->label('Números de Puertas')
                                    ->placeholder('Ej: 5')
                                    ->numeric()
                                    ->required()
                                    ->columnSpan(2)
                                    ->visible(function (Get $get) {
                                        $categoria = \App\Models\CategoriaAnuncio::find($get('categoria_anuncio_id'));
                                        return $categoria && $categoria->nombre === 'Autos Usados';
                                    }),
                                TextInput::make('num_pasajero')
                                    ->label('Números de Pasajeros')
                                    ->placeholder('Ej: 2')
                                    ->numeric()
                                    ->required()
                                    ->columnSpan(2)
                                    ->visible(function (Get $get) {
                                        $categoria = \App\Models\CategoriaAnuncio::find($get('categoria_anuncio_id'));
                                        return $categoria && $categoria->nombre === 'Autos Usados';
                                    }),
                                Select::make('vidrios')
                                    ->label('Tipo de vidrios')
                                    ->placeholder('Seleccione Tipo Vidrios')
                                    ->options([
                                        'electrico' => 'Eléctrico',
                                        'manual' => 'Manual',
                                    ])
                                    ->required()
                                    ->columnSpan(2)
                                    ->visible(function (Get $get) {
                                        $categoria = \App\Models\CategoriaAnuncio::find($get('categoria_anuncio_id'));
                                        return $categoria && $categoria->nombre === 'Autos Usados';
                                    }),
                                Select::make('condicion')
                                    ->label('Condición de vehículo')
                                    ->placeholder('Seleccione condición de vehículo')
                                    ->options([
                                        'usado' => 'Usado',
                                        'seminuevo' => 'Seminuevo',
                                    ])
                                    ->required()
                                    ->columnSpan(2)
                                    ->visible(function (Get $get) {
                                        $categoria = \App\Models\CategoriaAnuncio::find($get('categoria_anuncio_id'));
                                        return !$categoria || $categoria->nombre !== 'Motos Nuevas';
                                    })
                                    ->default(function (Get $get) {
                                        $categoria = \App\Models\CategoriaAnuncio::find($get('categoria_anuncio_id'));
                                        return $categoria && $categoria->nombre === 'Motos Nuevas' ? 'nuevo' : null;
                                    }),
                            ])

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

                            Section::make('Información del anuncio')
                                ->columns(6)
                                ->schema([
                                    TextInput::make('titulo')
                                        ->label('Título')
                                        ->required()
                                        ->columnSpanFull()
                                        ->reactive(),
                                    Textarea::make('descripcion')->required()->columnSpanFull(),
                                    Select::make('tipo')
                                        ->options([
                                            'premium' => 'Anuncio Premium',
                                            'standar' => 'Anuncio Standar',
                                        ])->columnSpan(2),
                                    TextInput::make('precio')->required()->numeric()->columnSpan(2),
                                    TextInput::make('link_video')->columnSpan(2),

                                    Select::make('estado_temp')
                                        ->label('Estado')
                                        ->options(Estado::pluck('nombre', 'id'))
                                        ->placeholder('Selecciona un estado')
                                        ->reactive()
                                        ->afterStateUpdated(fn (Set $set) => $set('municipio_id', null))
                                        ->dehydrated(false)
                                        ->columnSpan(2),
                                    Select::make('municipio_id')
                                        ->label('Municipio')
                                        ->placeholder('Selecciona un municipio')
                                        ->options(function (Get $get) {
                                            if (!$get('estado_temp')) {
                                                return [];
                                            }
                                            return \App\Models\Municipio::where('estado_id', $get('estado_temp'))
                                                ->pluck('nombre', 'id')
                                                ->toArray();
                                        })
                                        ->required()
                                        ->searchable()
                                        ->reactive()
                                        ->columnSpan(2),
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
