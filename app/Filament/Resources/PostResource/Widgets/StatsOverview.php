<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de Artículos', Post::count())
                ->icon('heroicon-o-document-text')
                ->color('gray'),

            Stat::make('Artículos Publicados', Post::where('published', true)->count())
                ->color('success')
                ->icon('heroicon-o-check-circle'),

            Stat::make('Total de Tags', Tag::count())
                ->icon('heroicon-o-hashtag')
                ->color('blue'),

            Stat::make('Total de Categorías', Category::count())
                ->icon('heroicon-o-rectangle-stack')
                ->color('indigo'),
        ];
    }
}
