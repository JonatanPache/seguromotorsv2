<?php

namespace App\Filament\Resources\PolizaResource\Pages;

use App\Filament\Resources\PolizaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPolizas extends ListRecords
{
    protected static string $resource = PolizaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
