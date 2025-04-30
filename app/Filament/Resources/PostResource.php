<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Storage;



class PostResource extends Resource
{

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationLabel  = 'Artículos de Blog';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?int    $navigationSort  = 1;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
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
                Filter::make('Publicados')
                    ->query(fn (Builder $query): Builder => $query->where('published', 1)),
                Filter::make('No publicados')
                    ->query(fn (Builder $query): Builder => $query->where('published', 0)),
                SelectFilter::make('category')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('¿Eliminar este artículo?')
                    ->modalDescription('¿Deseas eliminar este artículo? Esta acción no se puede deshacer.')
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
            RelationManagers\TagsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
