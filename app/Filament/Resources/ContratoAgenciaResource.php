<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContratoAgenciaResource\Pages;
use App\Filament\Resources\ContratoAgenciaResource\RelationManagers;
use App\Models\ContratoAgencia;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\ViewColumn;

class ContratoAgenciaResource extends Resource
{
    protected static ?string $model = ContratoAgencia::class;
    protected static ?string $label = 'Contrato';
    protected static ?string $pluralLabel = 'Contratos';
    protected static ?string $navigationGroup = 'Gestión de Agencias';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('agencia_id')
                    ->label('Agencia')
                    ->relationship('agencia', 'nombre')
                    ->required()
                    ->reactive()
                    ->columnSpanFull(),

                DatePicker::make('fecha_inicio')
                    ->required(),

                DatePicker::make('fecha_fin')
                    ->required(),

                TextInput::make('observaciones')
                    ->columnSpanFull(),

                FileUpload::make('archivo_contrato')
                    ->label('Subir Contrato')
                    ->disk('local')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
                    ->directory('contratos')
                    ->maxFiles(1)
                    ->required()
                    ->preserveFilenames()
                    ->columnSpanFull(),

                Select::make('estado')
                    ->label('Estado del Contrato')
                    ->options([
                        'activo' => 'Activo',
                        'vencido' => 'Vencido',
                        'cancelado' => 'Cancelado',
                    ])
                    ->visible(fn (string $operation) => $operation === 'edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial_number')
                    ->label('N°')
                    ->rowIndex(),
                TextColumn::make('agencia.nombre')->label('Agencia')->searchable(),
                TextColumn::make('fecha_inicio')->label('Inicio del contrato'),
                TextColumn::make('fecha_fin')->label('Fin del contrato'),
                ViewColumn::make('archivo_contrato')
                    ->label('Contrato')
                    ->view('components.descargar-contrato')
                    ->state(fn ($record) => route('contratos.descargar', ['filename' => basename($record->archivo_contrato)])),
                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->colors([
                        'success' => 'activo',
                        'danger' => 'vencido',
                        'warning' => 'cancelado',
                    ])
                    ->formatStateUsing(fn (string $state) => ucfirst($state)),
            ])
            ->filters([
                Filter::make('fecha_fin')
                    ->form([
                        Placeholder::make('')
                            ->content('Filtrar por Fecha de Vencimiento')
                            ->extraAttributes([
                                'class' => 'text-sm mb-0 font-semibold text-gray-700',
                            ]),

                        DatePicker::make('created_from')
                            ->label('Desde'),

                        DatePicker::make('created_until')
                            ->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fecha_fin', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fecha_fin', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('¿Estás seguro de eliminar este contrato?')
                    ->modalDescription('Esta acción no se puede deshacer. Se eliminará el contrato de forma permanente.')
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
            'index' => Pages\ManageContratoAgencias::route('/'),
        ];
    }
}
