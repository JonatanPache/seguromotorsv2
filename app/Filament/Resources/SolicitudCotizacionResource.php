<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SolicitudCotizacionResource\Pages;
use App\Filament\Resources\SolicitudCotizacionResource\RelationManagers;
use App\Forms\Components\ViewImage;
use App\Models\SolicitudCotizacion;
use Awcodes\FilamentBadgeableColumn\Components\BadgeField;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use WireUi\View\Components\Badge;
use FilamentCurator\Forms\Components\MediaPicker;


class SolicitudCotizacionResource extends Resource
{
    protected static ?string $model = SolicitudCotizacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Toggle::make('status')
                    ->label('Confirmar solicitud ?')
                    ->onIcon('heroicon-s-lightning-bolt')
                    ->offIcon('heroicon-s-user')
                    ->onColor('success')
                    ->offColor('danger'),
                TextInput::make('date')
                    ->disabled(),
                TextInput::make('seguro_id')
                    ->disabled(),
                TextInput::make('cliente_id')
                    ->disabled(),
                TextInput::make('conductor_id')
                    ->disabled(),
                TextInput::make('prima_id')
                    ->disabled(),
                TextInput::make('placa')
                    ->disabled(),
                Card::make()->schema([
                    FileUpload::make('image_hist_auto')
                        ->imagePreviewHeight('550')
                        ->enableOpen()
                        ->enableDownload()
                ]),
                Card::make()->schema([
                    FileUpload::make('image_hist_conduc')
                        ->imagePreviewHeight('550')
                        ->enableOpen()
                        ->enableDownload()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('date')->sortable()->searchable(),
                TextColumn::make('cliente.name')->sortable()->searchable(),
                TextColumn::make('seguro.name')->sortable()->searchable(),
                BooleanColumn::make('status'),
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
            'index' => Pages\ListSolicitudCotizacions::route('/'),
            'create' => Pages\CreateSolicitudCotizacion::route('/create'),
            'edit' => Pages\EditSolicitudCotizacion::route('/{record}/edit'),
        ];
    }
}
