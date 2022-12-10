<?php

namespace App\Filament\Resources\WidowResource\Pages;

use App\Filament\Resources\WidowResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWidow extends CreateRecord
{
    protected static string $resource = WidowResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
}
