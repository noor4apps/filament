<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New User', User::count())
                ->description('New users that have joined')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart([10, 20, 5, 40])
                ->color('success'),

            Stat::make('New Post', Post::count())
                ->description('New posts')
                ->descriptionIcon('heroicon-m-rectangle-stack', IconPosition::Before)
                ->chart([5, 30, 20, 50])
                ->color('info'),

            Stat::make('New comment', Comment::count())
                ->description('New comment')
                ->descriptionIcon('heroicon-m-folder', IconPosition::Before)
                ->chart([5, 30, 50, 40])
                ->color('success')
        ];
    }
}
