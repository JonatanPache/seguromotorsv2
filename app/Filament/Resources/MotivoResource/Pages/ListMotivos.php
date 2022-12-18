<?php

namespace App\Filament\Resources\MotivoResource\Pages;

use App\Filament\Resources\MotivoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMotivos extends ListRecords
{
    protected static string $resource = MotivoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
