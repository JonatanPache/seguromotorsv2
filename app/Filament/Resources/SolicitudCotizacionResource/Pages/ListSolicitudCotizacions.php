<?php

namespace App\Filament\Resources\SolicitudCotizacionResource\Pages;

use App\Filament\Resources\SolicitudCotizacionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSolicitudCotizacions extends ListRecords
{
    protected static string $resource = SolicitudCotizacionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
