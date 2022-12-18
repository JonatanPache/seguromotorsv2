<?php

namespace App\Filament\Resources\TimeResource\Pages;

use App\Filament\Resources\TimeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTimes extends ListRecords
{
    protected static string $resource = TimeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
