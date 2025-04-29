<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendedorResource\Pages;
use App\Filament\Resources\VendedorResource\RelationManagers;
use App\Models\Vendedor;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class VendedorResource extends Resource
{
    protected static ?string $model = Vendedor::class;

    protected static ?string $label = 'Vendedor';
    protected static ?string $pluralLabel = 'Vendedores';
    protected static ?string $navigationGroup = 'Administración';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')->required()->maxLength(255)->placeholder('Ingrese nombre del Vendedor'),
                TextInput::make('telefono')->maxLength(255)->placeholder('Ingrese teléfono Vendedor')->tel(),
                TextInput::make('email')->maxLength(255)->placeholder('Ingrese Email del vendedor')->email(),
                TextInput::make('whatsapp')->maxLength(255)->placeholder('Ingrese Whatsapp del vendedor')->tel(),
                FileUpload::make('perfil')
                    ->disk('public')
                    ->directory('vendedoresperfil')
                    ->image()
                    ->rules([
                        'dimensions:ratio=1/1',
                    ])
                    ->helperText('La imagen debe ser cuadrada (mismo ancho y alto).')
                    ->columnSpanFull()
                    ->deleteUploadedFileUsing(function ($file) {
                        Storage::disk('public')->delete($file);
                    })
                    ->getUploadedFileNameForStorageUsing(function ($file, $record, $get) {
                        $slug = $get('nombre') ?? 'sin-nombre';
                        $extension = $file->getClientOriginalExtension();
                        return $slug . '-perfil.' . $extension;
                    })
                    ->afterStateUpdated(function ($state, $set) {
                        if (is_array($state)) {
                            $set(reset($state));
                        }
                    })
                    ->dehydrateStateUsing(function ($state) {
                        return is_array($state) ? reset($state) : $state;
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial_number')
                    ->label('N°')
                    ->rowIndex(),
                TextColumn::make('nombre')->searchable()->sortable(),
                TextColumn::make('telefono')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->sortable(),
                TextColumn::make('whatsapp')->searchable()->sortable(),
                ImageColumn::make('perfil')->label('Foto')
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVendedors::route('/'),
        ];
    }
}
