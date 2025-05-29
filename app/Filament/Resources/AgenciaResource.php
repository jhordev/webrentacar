<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgenciaResource\Pages;
use App\Filament\Resources\AgenciaResource\RelationManagers;
use App\Models\Agencia;
use App\Models\Estado;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Storage;


class AgenciaResource extends Resource
{
    protected static ?string $model = Agencia::class;

    protected static ?string $label = 'Agencia';
    protected static ?string $pluralLabel = 'Agencias';
    protected static ?string $navigationGroup = 'Gestión de Agencias';
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información de la Agencia')
                    ->columns(2)
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre de la Agencia')
                            ->placeholder('Ej: Agencia Honda Motors')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required(),

                        TextInput::make('slug')
                            ->label('Slug (automático)')
                            ->placeholder('Ej: Agencia-Honda-Motors')
                            ->required(),

                        TextInput::make('direccion')
                            ->label('Dirección')
                            ->placeholder('Ej: Av. Siempre Viva 123')
                            ->required(),

                        TextInput::make('linkmaps')
                            ->label('Enlace de Google Maps')
                            ->placeholder('Ej: https://maps.google.com/...')
                            ->required(),

                        TextInput::make('ubicacion')
                            ->label('Ubicación detallada')
                            ->placeholder('Ej: Frente al Parque Central, piso 3')
                            ->required(),

                        Select::make('estado')
                            ->label('Estado de agencia')
                            ->options([
                                'activo' => 'Activo',
                                'inactivo' => 'Inactivo',
                            ])
                            ->required(),

                        Select::make('estado_temp')
                            ->label('Estado')
                            ->options(Estado::pluck('nombre', 'id'))
                            ->placeholder('Selecciona un estado')
                            ->reactive()
                            ->afterStateUpdated(fn (Set $set) => $set('municipio_id', null))
                            ->dehydrated(false),

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
                            ->reactive(),

                        Section::make('Contacto de la empresa')
                            ->columns(3)
                            ->schema([
                                TextInput::make('email')
                                    ->label('Correo electrónico')
                                    ->placeholder('Ej: contacto@agencia.com')
                                    ->email()
                                    ->required(),

                                TextInput::make('telefono')
                                    ->label('Teléfono')
                                    ->placeholder('Ej: (55) 1234 5678')
                                    ->tel()
                                    ->required(),

                                TextInput::make('whatsapp')
                                    ->label('Número de WhatsApp')
                                    ->placeholder('Ej: +52 1 55 1234 5678')
                                    ->tel()
                                    ->required(),
                            ]),
                    ]),

                Section::make('Contacto')
                    ->description('Persona de contacto con la empresa')
                    ->columns(3)
                    ->schema([
                        TextInput::make('nom_contacto')
                            ->label('Nombre del contacto')
                            ->placeholder('Ej: Juan Pérez')
                            ->required(),

                        TextInput::make('tel_contacto')
                            ->label('Teléfono del contacto')
                            ->placeholder('Ej: (55) 9876 5432')
                            ->tel()
                            ->required(),

                        TextInput::make('email_contacto')
                            ->label('Correo del contacto')
                            ->placeholder('Ej: juan.perez@empresa.com')
                            ->email()
                            ->required(),
                    ]),

                Section::make('Imágenes')
                    ->description('Logotipo y banner de la agencia')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('logo')
                            ->disk('public')
                            ->directory('logos')
                            ->image()
                            ->required()
                            ->deleteUploadedFileUsing(function ($file) {
                                Storage::disk('public')->delete($file);
                            })
                            ->getUploadedFileNameForStorageUsing(function ($file, $record, $get) {
                                $slug = $get('slug') ?? 'sin-slug';
                                $extension = $file->getClientOriginalExtension();
                                return $slug . '-logo.' . $extension;
                            })
                            ->afterStateUpdated(function ($state, $set) {
                                // Esto asegura que el estado sea siempre el string directo
                                if (is_array($state)) {
                                    $set(reset($state));
                                }
                            })
                            ->dehydrateStateUsing(function ($state) {
                                // Asegurarnos de devolver solo el string
                                return is_array($state) ? reset($state) : $state;
                            }),

                        FileUpload::make('banner')
                            ->disk('public')
                            ->directory('banners')
                            ->image()
                            ->required()
                            ->deleteUploadedFileUsing(function ($file) {
                                Storage::disk('public')->delete($file);
                            })
                            ->getUploadedFileNameForStorageUsing(function ($file, $record, $get) {
                                $slug = $get('slug') ?? 'sin-slug';
                                $extension = $file->getClientOriginalExtension();
                                return $slug . '-banner.' . $extension;
                            })
                            ->afterStateUpdated(function ($state, $set) {
                                if (is_array($state)) {
                                    $set(reset($state));
                                }
                            })
                            ->dehydrateStateUsing(function ($state) {
                                return is_array($state) ? reset($state) : $state;
                            })
                    ]),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial_number')
                    ->label('N°')
                    ->rowIndex(),
                TextColumn::make('nombre')->searchable(),
                TextColumn::make('direccion'),
                TextColumn::make('tel_contacto')->label('Contacto'),
                TextColumn::make('municipio.estado.nombre')
                    ->label('Estado')
                    ->searchable(),
                TextColumn::make('municipio.nombre')->label('Municipio')->searchable(),
                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->colors([
                        'success' => 'activo',    // Verde para "activo"
                        'danger' => 'inactivo',   // Rojo para "inactivo"
                    ])
                    ->formatStateUsing(fn (string $state) => ucfirst($state)),
            ])
            ->filters([
                SelectFilter::make('estado')
                    ->options([
                        'activo' => 'Activo',
                        'inactivo' => 'Inactivo',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('¿Estas seguro de eliminar esta Agencia?')
                    ->modalDescription('Eliminar esta agencia también eliminará todos los contratos relacionados con ella. Esta acción no se puede deshacer.')
                    ->modalSubmitActionLabel('Sí, estoy seguro')
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
            RelationManagers\ContratoAgenciaRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgencias::route('/'),
            'create' => Pages\CreateAgencia::route('/create'),
            'edit' => Pages\EditAgencia::route('/{record}/edit'),
        ];
    }
}
