<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicioSIniestroResource\Pages;
use App\Filament\Resources\ServicioSIniestroResource\RelationManagers;
use App\Models\ServicioSiniestro;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServicioSIniestroResource extends Resource
{
    protected static ?string $model = ServicioSiniestro::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('empleado_id')
                ->relationship('Empleado', 'name'),
            Select::make('solicitud_siniestro_id')
                ->relationship('SolicitudSiniestro', 'id'),
                TextInput::make('observaciones'),
            TextInput::make('total_costo'),
            TextInput::make('latitude')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServicioSIniestros::route('/'),
            'create' => Pages\CreateServicioSIniestro::route('/create'),
            'edit' => Pages\EditServicioSIniestro::route('/{record}/edit'),
        ];
    }
}
