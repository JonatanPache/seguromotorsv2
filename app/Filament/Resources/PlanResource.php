<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Filament\Resources\PlanResource\RelationManagers;
use App\Models\Plan;
use App\Models\Asistencia;
use App\Models\Cobertura;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

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
                                Select::make('time_id')
                                    ->relationship('time', 'name')->required(),
                            ]),
                        Card::make()
                            ->schema([
                                Repeater::make('planAsistencia')
                                    ->relationship()
                                    ->schema([
                                        Select::make('asistencia_id')
                                            ->label('Asistencia')
                                            ->options(Asistencia::query()->pluck('name','id'))

                                            ->reactive()
                                    ])
                                    ->defaultItems(1)
                                    ->columnSpanFull(),
                                Repeater::make('planCobertura')
                                    ->relationship()
                                    ->schema([
                                        Select::make('cobertura_id')
                                            ->label('Cobertura')
                                            ->options(Cobertura::query()->pluck('name','id'))
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
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
