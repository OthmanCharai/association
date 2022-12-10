<?php

namespace App\Filament\Resources\WidowResource\Pages;

use App\Filament\Resources\WidowResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWidows extends ListRecords
{
    protected static string $resource = WidowResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),


        ];
    }
}
