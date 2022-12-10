<?php

namespace App\Filament\Widgets;

use App\Models\Child;
use App\Models\Widow;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            //
            Card::make(__('filament::pages/dashboard.veuves'),Widow::count()),
            Card::make(__('filament::pages/dashboard.children'),Child::count()),
            Card::make(__('filament::pages/dashboard.parrains'),Widow::count()),

        ];
    }
}
