<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Cobertura;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CoberturaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CoberturaResource\RelationManagers;
use App\Models\CoberturaTipo;
use App\Models\TipoCobertura;

class CoberturaResource extends Resource
{
    protected static ?string $model = Cobertura::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Seguro Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('name'),
                                TextInput::make('description')
                            ]),
                        Card::make()
                            ->schema([
                                Repeater::make('coberturaTipo')
                                    ->relationship()
                                    ->schema([
                                        Select::make('cobertura_tipo_id')
                                            ->label('Cobertura')
                                            ->options(TipoCobertura::query()->pluck('name','id'))
                                            ->required()
                                            ->reactive(),
                                        Select::make('moneda_id')
                                            ->relationship('moneda','name')->required(),
                                        TextInput::make('porcentaje_cob')->label('Porcentaje Cobertura'),
                                        TextInput::make('porcentaje_partir')->label('Porcentaje a partir del riesgo'),
                                        TextInput::make('monto_cobertura')->label('Monto'),
                                        TextInput::make('limite_max')->label('Limite Max'),
                                        TextInput::make('prima_cant')->label('Cantidad Prima')
                                    ])
                                    ->defaultItems(1)

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
            'index' => Pages\ListCoberturas::route('/'),
            'create' => Pages\CreateCobertura::route('/create'),
            'edit' => Pages\EditCobertura::route('/{record}/edit'),
        ];
    }
}