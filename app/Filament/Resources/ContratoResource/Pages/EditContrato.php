<?php

namespace App\Filament\Resources\ContratoResource\Pages;

use App\Filament\Resources\ContratoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContrato extends EditRecord
{
    protected static string $resource = ContratoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
