<?php

namespace App\Filament\Resources\AgenciaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContratoAgenciaRelationManager extends RelationManager
{
    protected static string $relationship = 'contratos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('agencia_id')
            ->columns([
                TextColumn::make('serial_number')
                    ->label('N°')
                    ->rowIndex(),
                TextColumn::make('agencia.nombre')->label('Agencia')->searchable(),
                TextColumn::make('fecha_inicio')->label('Inicio del contrato'),
                TextColumn::make('fecha_fin')->label('Fin del contrato'),
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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
