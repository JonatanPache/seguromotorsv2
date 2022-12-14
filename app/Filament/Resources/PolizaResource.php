<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PolizaResource\Pages;
use App\Filament\Resources\PolizaResource\RelationManagers;
use App\Models\Poliza;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PolizaResource extends Resource
{
    protected static ?string $model = Poliza::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('detalle')->sortable()->searchable(),
                TextColumn::make('user.name')->sortable()->searchable(),
                TextColumn::make('date_start')->sortable()->searchable(),
                TextColumn::make('date_end')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()
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
            'index' => Pages\ListPolizas::route('/'),
            'create' => Pages\CreatePoliza::route('/create'),
            'edit' => Pages\EditPoliza::route('/{record}/edit'),
        ];
    }
}
