<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use App\Models\TipoCobertura;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TipoCoberturaResource\Pages;
use App\Filament\Resources\TipoCoberturaResource\RelationManagers;
use App\Models\Motivo;

class TipoCoberturaResource extends Resource
{
    protected static ?string $model = TipoCobertura::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Group::make()
                ->schema([
                    Card::make()
                        ->schema([
                            TextInput::make('name'),
                            TextInput::make('description'),
                        ]),
                    Card::make()
                        ->schema([
                            Repeater::make('tipoCoberturaMotivo')
                                ->relationship()
                                ->schema([
                                    Select::make('motivo_id')
                                        ->label('Motivos')
                                        ->options(Motivo::query()->pluck('name','id'))
                                        ->required()
                                        ->reactive()
                                ])
                                ->defaultItems(1)
                                ->columnSpanFull()
                        ])
                ])->columnSpanFull()

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('description')->sortable()->searchable(),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTipoCoberturas::route('/'),
            'create' => Pages\CreateTipoCobertura::route('/create'),
            'edit' => Pages\EditTipoCobertura::route('/{record}/edit'),
        ];
    }
}
