<?php

namespace App\Filament\Resources\CotizacionResource\Pages;

use App\Filament\Resources\CotizacionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCotizacions extends ListRecords
{
    protected static string $resource = CotizacionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
