<?php

namespace App\Filament\Resources\ServicioSIniestroResource\Pages;

use App\Filament\Resources\ServicioSIniestroResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServicioSIniestro extends EditRecord
{
    protected static string $resource = ServicioSIniestroResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
