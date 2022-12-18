<?php

namespace App\Filament\Resources\TipoCoberturaResource\Pages;

use App\Filament\Resources\TipoCoberturaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoCobertura extends EditRecord
{
    protected static string $resource = TipoCoberturaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
