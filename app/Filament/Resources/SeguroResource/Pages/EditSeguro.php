<?php

namespace App\Filament\Resources\SeguroResource\Pages;

use App\Filament\Resources\SeguroResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeguro extends EditRecord
{
    protected static string $resource = SeguroResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
