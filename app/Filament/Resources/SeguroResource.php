<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Plan;
use Filament\Tables;
use App\Models\Seguro;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SeguroResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SeguroResource\RelationManagers;

class SeguroResource extends Resource
{
    protected static ?string $model = Seguro::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('description'),
                Select::make('plan_id')
                    ->relationship('plan', 'name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $plan = Plan::find($state);
                        if ($plan) {
                            $set('cost', $plan->cost);
                        }
                    }),
                TextInput::make('cost')->disabled(),
                Toggle::make('is_enable')
                    ->onIcon('heroicon-s-lightning-bolt')
                    ->offIcon('heroicon-s-user')
                    ->onColor('success')
                    ->offColor('danger')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('description')->sortable()->searchable(),
                TextColumn::make('cost')->sortable()->searchable(),
                BadgeColumn::make('is_enable')
                    ->colors([
                        'primary',
                        'secondary' => 'draft',
                        'warning' => 'reviewing',
                        'success' => 'published',
                        'danger' => 'rejected',
                    ]),
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
            'index' => Pages\ListSeguros::route('/'),
            'create' => Pages\CreateSeguro::route('/create'),
            'edit' => Pages\EditSeguro::route('/{record}/edit'),
        ];
    }
}
