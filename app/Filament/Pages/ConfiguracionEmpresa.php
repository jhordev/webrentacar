<?php

namespace App\Filament\Pages;

use App\Models\ConfigEmpresa;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Forms\Components\{Section, Grid, TextInput, FileUpload, Repeater, Hidden};
use Illuminate\Support\Facades\Storage;

class ConfiguracionEmpresa extends Page
{
    protected static ?string $navigationGroup  = 'Configuración';
    protected static ?int    $navigationSort   = 2;
    protected static ?string $navigationIcon   = 'heroicon-o-building-office';
    protected static ?string $navigationLabel  = 'Configuración Empresa';
    protected static string  $view             = 'filament.pages.configuracion-empresa';

    public array $formData = [];

    public function mount(): void
    {
        $empresa = ConfigEmpresa::with(['redesSociales' => function($query) {
            $query->orderBy('orden'); // Ordenar por el campo 'orden'
        }])->firstOrCreate(['id' => 1]);

        $this->formData = [
            ...$empresa->only([
                'nombre','logo','direccion','email',
                'telefono','whatsapp','sitio_web',
            ]),
            'redes_sociales' => $empresa->redesSociales
                ->map(fn($r) => $r->only(['id','nombre_red','url','orden']))
                ->toArray(),
        ];

        $this->form->fill($this->formData);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Datos generales')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('nombre')->required(),
                                TextInput::make('direccion'),
                                TextInput::make('email')->email(),
                                TextInput::make('telefono'),
                                TextInput::make('whatsapp'),
                                TextInput::make('sitio_web'),
                                FileUpload::make('logo')->directory('logo'),
                            ]),
                    ]),

                Section::make('Redes sociales')
                    ->schema([
                        Repeater::make('redes_sociales')
                            ->label(false)
                            ->reorderable()
                            ->columns(2)
                            ->schema([
                                Hidden::make('id'),
                                TextInput::make('nombre_red')->required(),
                                TextInput::make('url')->required(),
                                Hidden::make('orden'),
                            ])
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('formData');
    }

    public function submit(): void
    {
        $empresa = ConfigEmpresa::firstOrCreate(['id' => 1]);

        // Guardar los datos principales
        $empresa->fill($this->formData)->save();

        $idsConservados = [];
        $items = $this->formData['redes_sociales'] ?? [];

        foreach (array_values($items) as $index => $red) {
            $red['orden'] = $index + 1;

            $registro = $empresa->redesSociales()->updateOrCreate(
                ['id' => $red['id'] ?? null],
                $red
            );

            $idsConservados[] = $registro->id;
        }

        $empresa->redesSociales()
            ->whereNotIn('id', $idsConservados)
            ->delete();

        Notification::make()
            ->title('Configuración actualizada')
            ->success()
            ->send();
    }
}
