<?php

namespace App\Filament\Resources\CoaseguroResource\Pages;

use App\Filament\Resources\CoaseguroResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoaseguros extends ListRecords
{
    protected static string $resource = CoaseguroResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
