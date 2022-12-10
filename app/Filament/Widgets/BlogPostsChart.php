<?php

namespace App\Filament\Widgets;

use App\Models\Widow;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class BlogPostsChart extends LineChartWidget
{
    protected static ?string $heading =  'Veuves';

    protected static ?int $sort=2;

    protected function getData(): array
    {
        $data = Trend::model(Widow::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            //
        'datasets' => [
        [
            'label' =>  __('filament::pages/dashboard.veuves'),
            'data' => $data->map(static fn (TrendValue $value) => $value->aggregate),
        ],
    ],
            'labels' => $data->map(static fn (TrendValue $value) => $value->date),
        ];
    }

    protected  function getHeading(): ?string
    {
        return __('filament::pages/dashboard.veuves');
    }
}
