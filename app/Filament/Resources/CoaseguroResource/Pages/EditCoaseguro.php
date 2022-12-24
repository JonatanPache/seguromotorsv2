<?php

namespace App\Filament\Resources\CoaseguroResource\Pages;

use App\Filament\Resources\CoaseguroResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoaseguro extends EditRecord
{
    protected static string $resource = CoaseguroResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
