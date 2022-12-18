<?php

namespace App\Filament\Resources\BeneficioResource\Pages;

use App\Filament\Resources\BeneficioResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeneficio extends EditRecord
{
    protected static string $resource = BeneficioResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
