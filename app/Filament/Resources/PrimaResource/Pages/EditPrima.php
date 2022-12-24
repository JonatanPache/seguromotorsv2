<?php

namespace App\Filament\Resources\PrimaResource\Pages;

use App\Filament\Resources\PrimaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrima extends EditRecord
{
    protected static string $resource = PrimaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
