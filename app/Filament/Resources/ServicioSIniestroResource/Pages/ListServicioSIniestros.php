<?php

namespace App\Filament\Resources\ServicioSIniestroResource\Pages;

use App\Filament\Resources\ServicioSIniestroResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServicioSIniestros extends ListRecords
{
    protected static string $resource = ServicioSIniestroResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
