<?php

namespace App\Filament\Resources\PolizaResource\Pages;

use App\Filament\Resources\PolizaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPoliza extends EditRecord
{
    protected static string $resource = PolizaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
