<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\City;
use App\Models\User;
use Filament\Tables;
use App\Models\Vehiculo;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\TipoUsoVehiculo;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use App\Models\TipoServicioVehiculo;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\TipoCombustible;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'User Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('ci')->label(__('Carnet Identidad')),
                                TextInput::make('name'),
                                TextInput::make('last_name'),
                                TextInput::make('email')
                                    ->email(),
                                TextInput::make('password')
                                    ->password()
                                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                                TextInput::make('phone')
                                    ->tel()
                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                                TextInput::make('address'),
                                DatePicker::make('birthday'),
                                Select::make('rol_id')
                                    ->relationship('rol', 'name')->required(),
                                Select::make('city_id')
                                    ->relationship('city', 'name')->required(),
                                Map::make('location')->mapControls([
                                    'mapTypeControl'    => true,
                                    'scaleControl'      => true,
                                    'streetViewControl' => true,
                                    'rotateControl'     => true,
                                    'fullscreenControl' => true,
                                    'searchBoxControl'  => false, // creates geocomplete field inside map
                                    'zoomControl'       => false,
                                ]),
                            ]),
                        Card::make()
                            ->schema([
                                Repeater::make('userVehiculo')
                                    ->relationship()
                                    ->schema([
                                        Select::make('vehiculo_id')
                                            ->label('Vehiculo')
                                            ->options(Vehiculo::query()->pluck('clase', 'modelo', 'id'))
                                            ->reactive(),
                                        Select::make('tipo_servicio_id')
                                            ->label('Servicio')
                                            ->options(TipoServicioVehiculo::query()->pluck('name', 'id'))
                                            ->reactive(),
                                        Select::make('tipo_uso_id')
                                            ->label('Tipo Uso')
                                            ->options(TipoUsoVehiculo::query()->pluck('name', 'id'))
                                            ->reactive(),
                                        Select::make('city_id')
                                            ->label('City')
                                            ->options(City::query()->pluck('name', 'id'))
                                            ->reactive(),
                                        Select::make('tipo_combustible_id')
                                            ->label('Tipo Combustible')
                                            ->options(TipoCombustible::query()->pluck('name', 'id'))
                                            ->reactive(),
                                        TextInput::make('placa'),
                                        TextInput::make('valor_comercial'),
                                        FileUpload::make('image1')
                                            ->required(),
                                        FileUpload::make('image2'),
                                        FileUpload::make('image3')
                                    ])
                                    ->defaultItems(1)
                                    ->columnSpanFull(),
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
                TextColumn::make('phone')->sortable()->searchable(),
                TextColumn::make('city.name')->sortable()->searchable(),
                TextColumn::make('rol.name')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                SelectFilter::make('city')->relationship('city', 'name'),
                SelectFilter::make('rol')->relationship('rol', 'name')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
