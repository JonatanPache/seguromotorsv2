<?php

namespace App\Filament\Resources\LimiteResource\Pages;

use App\Filament\Resources\LimiteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLimite extends EditRecord
{
    protected static string $resource = LimiteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
