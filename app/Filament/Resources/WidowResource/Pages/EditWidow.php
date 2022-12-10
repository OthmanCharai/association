<?php

namespace App\Filament\Resources\WidowResource\Pages;

use App\Filament\Resources\WidowResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWidow extends EditRecord
{
    protected static string $resource = WidowResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),

        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
