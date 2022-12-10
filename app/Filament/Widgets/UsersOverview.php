<?php

namespace App\Filament\Widgets;

use App\Models\Child;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UsersOverview extends BaseWidget
{
    protected static ?int $sort = -3;

    protected function getCards(): array
    {
        $children=Child::withCount(['widow','sponsor'])->get();
        return [
            //
            Card::make(__('filament::pages/dashboard.a'),count($children))
        ];
    }
}
