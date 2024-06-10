<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        return [
            $this->createStat(
                'New User',
                User::class,
                'New users that have joined',
                'heroicon-m-user-group',
                'success',
                [10, 20, 5, 40]
            ),
            $this->createStat(
                'New Post',
                Post::class,
                'New posts',
                'heroicon-m-rectangle-stack',
                'info',
                [5, 30, 20, 50]
            ),
            $this->createStat(
                'New Comment',
                Comment::class,
                'New comments',
                'heroicon-m-folder',
                'success',
                [5, 30, 50, 40]
            )
        ];
    }

    protected function createStat(string $title, string $model, string $description, string $icon, string $color, array $chart): Stat
    {
        $start = $this->filters['startDate'];
        $end = $this->filters['endDate'];

        $count = $model::query()
            ->when($start, fn($q) => $q->whereDate('created_at', '>=', $start))
            ->when($end, fn($q) => $q->whereDate('created_at', '<=', $end))
            ->count();

        return Stat::make($title, $count)
            ->description($description)
            ->descriptionIcon($icon, IconPosition::Before)
            ->chart($chart)
            ->color($color);
    }
}
