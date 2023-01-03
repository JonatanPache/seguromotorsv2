<?php

namespace App\Filament\Resources\FacturasResource\Pages;

use App\Filament\Resources\FacturasResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFacturas extends ListRecords
{
    protected static string $resource = FacturasResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
