<?php

namespace App\Filament\Resources\TipoCoberturaResource\Pages;

use App\Filament\Resources\TipoCoberturaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoCoberturas extends ListRecords
{
    protected static string $resource = TipoCoberturaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
