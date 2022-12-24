<?php

namespace App\Filament\Resources\SolicitudCotizacionResource\Pages;

use App\Filament\Resources\SolicitudCotizacionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSolicitudCotizacion extends EditRecord
{
    protected static string $resource = SolicitudCotizacionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
