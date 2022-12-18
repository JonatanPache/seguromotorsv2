<?php

namespace App\Filament\Resources\CoberturaResource\Pages;

use App\Filament\Resources\CoberturaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCobertura extends EditRecord
{
    protected static string $resource = CoberturaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
