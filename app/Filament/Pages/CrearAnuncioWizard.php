<?php

namespace App\Filament\Pages;

use App\Filament\Resources\AnuncioResource;
use App\Models\DetalleVehiculo;
use App\Models\Estado;
use App\Models\FotoAnuncio;
use App\Models\MarcaVehiculo;
use App\Models\ModeloVehiculo;
use Filament\Forms;
use Filament\Forms\Components\{FileUpload, Hidden, Section, Select, Textarea, TextInput, Toggle, Wizard, Wizard\Step};
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Page;
use Filament\Actions\Action;



class CrearAnuncioWizard extends Page implements Forms\Contracts\HasForms
{
    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';

    public static function getNavigationLabel(): string
    {
        return 'Crear Anuncio';
    }

    public function getTitle(): string
    {
        return 'Crear Anuncio';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Administrador de anuncios';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    use Forms\Concerns\InteractsWithForms;

    protected static string $view = 'filament.pages.crear-anuncio-wizard';

    public ?array $data = [];
    protected array $imagenes = [];
    protected array $detalles = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
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

        return [
            Wizard::make([
                Step::make('Categoría del anuncio')
                    ->schema([
                        Select::make('id_categoria')
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
                Step::make('Datos del vehiculo')
                    ->schema([
                        Section::make()->columns(6)->schema([
                            Select::make('tipo_id')
                                ->label('Tipo de Vehículo')
                                ->options(function (Get $get) {
                                    $categoriaId = $get('id_categoria');
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
                                    $categoriaId = $get('id_categoria');
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
                                ->dehydrated(true)
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
                                    $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));

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
                            TextInput::make('color')
                                ->label('Ingrese el color')
                                ->required()
                                ->columnSpan(2),
                            Select::make('vestidura')
                                ->label('Seleccione vestidura')
                                ->placeholder('Seleccione Vestidura')
                                ->options([
                                    'tela' => 'Tela',
                                    'piel' => 'Piel',
                                ])
                                ->required()
                                ->columnSpan(2)
                                ->visible(function (Get $get) {
                                    $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
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
                                    $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
                                    return $categoria && $categoria->nombre === 'Autos Usados';
                                }),
                            TextInput::make('num_pasajero')
                                ->label('Números de Pasajeros')
                                ->placeholder('Ej: 2')
                                ->numeric()
                                ->required()
                                ->columnSpan(2)
                                ->visible(function (Get $get) {
                                    $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
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
                                    $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
                                    return $categoria && $categoria->nombre === 'Autos Usados';
                                }),
                            Select::make('condicion')
                                ->label('Condición de vehículo')
                                ->placeholder('Seleccione condición de vehículo')
                                ->options(function (Get $get) {
                                    $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
                                    return ($categoria && $categoria->nombre === 'Motos Nuevas')
                                        ? ['nuevo' => 'Nuevo']
                                        : ['usado' => 'Usado', 'seminuevo' => 'Seminuevo'];
                                })
                                ->default(function (Get $get) {
                                    $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
                                    return ($categoria && $categoria->nombre === 'Motos Nuevas') ? 'nuevo' : null;
                                })
                                ->required()
                                ->dehydrated(true)
                                ->columnSpan(2)
                                ->visible(function (Get $get) {
                                    $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
                                    // Oculta el select si es "Motos Nuevas"
                                    return !$categoria || $categoria->nombre !== 'Motos Nuevas';
                                }),
                            Hidden::make('condicion')
                                ->default('nuevo')
                                ->dehydrated(true)
                                ->visible(function (Get $get) {
                                    $categoria = \App\Models\CategoriaAnuncio::find($get('id_categoria'));
                                    return $categoria && $categoria->nombre === 'Motos Nuevas';
                                }),

                        ])

                    ]),
                Step::make('Fotos del vehiculo')
                    ->schema([
                        FileUpload::make('imagenes')
                            ->label('Fotos del vehículo')
                            ->multiple()
                            ->maxFiles(16)
                            ->reorderable()
                            ->image()
                            ->directory('anuncios/fotos')
                            ->preserveFilenames()
                            ->required()
                            ->columnSpanFull(),
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
                            ])
                    ])
            ])
                ->columnSpanFull()
                ->statePath('data')
                ->submitAction(
                    Action::make('submit')
                        ->label('Guardar anuncio')
                        ->color('primary')
                        ->icon('heroicon-o-check')
                        ->submit('submit')
                )

        ];
    }

    protected function getFormModel(): string
    {
        return \App\Models\Anuncio::class;
    }

    public function submit(): void
    {
        $formState = $this->form->getState();
        $data = $formState['data'] ?? [];

        $this->imagenes = $data['imagenes'] ?? [];
        unset($data['imagenes']);

        $ultimo = \App\Models\Anuncio::max('num_anuncio');
        $data['num_anuncio'] = $ultimo ? $ultimo + 1 : 1000001;

        $data['estado'] = 1;

        $anuncio = \App\Models\Anuncio::create($data);

        foreach ($this->imagenes as $index => $ruta) {
            FotoAnuncio::create([
                'anuncio_id' => $anuncio->id,
                'image' => $ruta,
                'orden' => $index + 1,
            ]);
        }

        DetalleVehiculo::create([
            'anuncio_id'   => $anuncio->id,
            'modelo_id'    => isset($data['modelo_id']) ? (int)$data['modelo_id'] : null,
            'anio'         => $data['anio'] ?? null,
            'tipo_id'      => $data['tipo_id'] ?? null,
            'combustible'  => $data['combustible'] ?? null,
            'motor'        => $data['motor'] ?? null,
            'color'        => $data['color'] ?? null,
            'vestidura'    => $data['vestidura'] ?? null,
            'kilometraje'  => $data['kilometraje'] ?? null,
            'num_puerta'   => $data['num_puerta'] ?? null,
            'num_pasajero' => $data['num_pasajero'] ?? null,
            'vidrios'      => $data['vidrios'] ?? null,
            'condicion'    => $data['condicion'] ?? null,
        ]);

        $this->redirect(AnuncioResource::getUrl('index'));
    }

}
