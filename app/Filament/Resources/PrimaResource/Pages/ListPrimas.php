<?php

namespace App\Filament\Resources\PrimaResource\Pages;

use App\Filament\Resources\PrimaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrimas extends ListRecords
{
    protected static string $resource = PrimaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
