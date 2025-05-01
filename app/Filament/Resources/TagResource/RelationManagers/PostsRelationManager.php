<?php

namespace App\Filament\Resources\TagResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'Posts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('category_id')
                            ->label('Categoría del artículo')
                            ->placeholder('Selecciona una categoría')
                            ->required()
                            ->relationship('category', 'name'),

                        TextInput::make('title')
                            ->label('Título del artículo')
                            ->placeholder('Escribe el título aquí')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required(),

                        TextInput::make('slug')
                            ->label('Slug (automático)')
                            ->placeholder('Se genera automáticamente a partir del título')
                            ->required(),

                        FileUpload::make('image')
                            ->label('Imagen principal del artículo')
                            ->helperText('Esta imagen se mostrará como portada en el listado o tarjeta del artículo.')
                            ->disk('public')
                            ->directory('articleimg')
                            ->image()
                            ->required()
                            ->getUploadedFileNameForStorageUsing(function ($file, $record, $get) {
                                $slug = $get('slug') ?? 'sin-slug';
                                $extension = $file->getClientOriginalExtension();
                                return $slug . '-articleprincipal.' . $extension;
                            })
                            ->deleteUploadedFileUsing(function ($file, $record) {
                                if ($record && $record->logo && Storage::disk('public')->exists($record->logo)) {
                                    Storage::disk('public')->delete($record->logo);
                                }
                            })
                            ->afterStateUpdated(function ($state, $set) {
                                if (is_array($state)) {
                                    $set(reset($state));
                                }
                            })
                            ->dehydrateStateUsing(function ($state) {
                                return is_array($state) ? reset($state) : $state;
                            }),

                        RichEditor::make('content')
                            ->label('Contenido del artículo')
                            ->placeholder('Escribe el contenido completo aquí...')
                            ->required()
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h1',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('imgcontentarticles')
                            ->fileAttachmentsVisibility('public'),

                        Toggle::make('published')
                            ->label('¿Publicar artículo?')
                            ->helperText('Activa esta opción si deseas que el artículo esté visible públicamente.')
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('serial_number')
                    ->label('N°')
                    ->rowIndex(),
                TextColumn::make('title')->limit('50')->sortable()->searchable()->label('Titulo de artículo'),
                TextColumn::make('slug')->limit('50'),
                TextColumn::make('created_at')->label('Creado')->dateTime('d/m/Y H:i'),
                ImageColumn::make('image')->disk('public')->label('Imagen principal'),
                IconColumn::make('published')
                    ->label('Publicado')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Crear nuevo post'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->disabled(fn ($record) => $record->Tags()->count() > 0)
                    ->tooltip('Este Post no puede eliminarse porque está asociado a uno o más posts')

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
