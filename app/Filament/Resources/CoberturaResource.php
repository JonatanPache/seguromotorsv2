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
use App\Models\Limite;
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
                                TextInput::make('description'),
                                Select::make('status')
                                    ->options([
                                        'new' => 'New',
                                        'processing' => 'Processing',
                                        'up' => 'Up',
                                        'down' => 'Down',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->reactive()
                            ]),
                        Card::make()
                            ->schema([
                                Repeater::make('coberturaTipo')
                                    ->relationship()
                                    ->schema([
                                        Select::make('cobertura_tipo_id')
                                            ->label('Cobertura')
                                            ->options(TipoCobertura::query()->pluck('name', 'id'))
                                            ->required()
                                            ->reactive(),
                                        TextInput::make('porcentaje_cob')->label('Porcentaje Cobertura'),
                                        TextInput::make('monto_cobertura')->label('Monto'),
                                        Select::make('limite_id')
                                            ->label('Limite')
                                            ->options(Limite::query()->pluck('name', 'id'))
                                            ->required()
                                            ->reactive()
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
        return [];
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
