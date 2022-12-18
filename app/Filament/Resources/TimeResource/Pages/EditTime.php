<?php

namespace App\Filament\Resources\TimeResource\Pages;

use App\Filament\Resources\TimeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTime extends EditRecord
{
    protected static string $resource = TimeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
