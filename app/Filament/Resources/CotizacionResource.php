<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CotizacionResource\Pages;
use App\Filament\Resources\CotizacionResource\RelationManagers;
use App\Filament\Resources\CotizacionResource\RelationManagers\ContratoRelationManager;
use App\Models\CoberturaTipo;
use App\Models\Cotizacion;
use App\Models\Deducible;
use App\Models\Limite;
use App\Models\SolicitudCotizacion;
use App\Models\TipoCobertura;
use App\Models\UserVehiculo;
use Awcodes\FilamentBadgeableColumn\Components\BadgeField;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Laravel\SerializableClosure\Support\SelfReference;

class CotizacionResource extends Resource
{
    public static ?string $soli_id;
    protected static ?string $model = Cotizacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Group::make()->schema([
                    Select::make('solicitud_id')
                        ->relationship('solicitud', 'id')
                        ->options(
                            SolicitudCotizacion::where('status', '=', '1')
                                ->pluck('id', 'id')
                        )
                        ->required()
                        ->afterStateUpdated(function ($state, callable $set) {
                            $sol = SolicitudCotizacion::find($state);
                            if ($sol) {
                                $set('date_start', Carbon::now()->toDateString());
                                $set('date_end', Carbon::now()->addYear()->toDateString());
                            }
                        })
                        ->reactive(),
                    Select::make('coaseguro_id')
                        ->relationship('coaseguro', 'name')->required(),
                    TextInput::make('date_start')->label(__('Fecha Inicial')),
                    TextInput::make('date_end')->label(__('Fecha Final')),
                    TextInput::make('prima_neta')->label('Prima Neta'),
                    TextInput::make('gastos')->label('Gasto Expedicion'),
                    TextInput::make('total_primas')->label('Valor Prima Total'),
                    TextInput::make('iva')->label('IVA (13%)'),
                    TextInput::make('prima_total')->label('Precio Prima Total'),
                    TextInput::make('descuento')->label('Recargo Financiero'),
                    Toggle::make('status')->label('Confirmar')
                ]), Group::make()->schema([
                    Repeater::make('cotizacionDeducible')
                        ->relationship()
                        ->schema([
                            Select::make('tipo_cobertura_id')
                                ->label('Tipo Cobertura')
                                ->options(function (callable $get) {
                                    $solic = SolicitudCotizacion::find($get('../../solicitud_id'));
                                    if ($solic) {
                                        return SolicitudCotizacion::select('tipo_coberturas.*')
                                            ->join('seguros', 'seguros.id', '=', 'solicitud_cotizacions.seguro_id')
                                            ->join('plans', 'plans.id', '=', 'seguros.plan_id')
                                            ->join('plan_coberturas', 'plan_coberturas.plan_id', '=', 'plans.id')
                                            ->join('coberturas', 'coberturas.id', '=', 'plan_coberturas.cobertura_id')
                                            ->join('cobertura_tipos', 'cobertura_tipos.cobertura_id', '=', 'coberturas.id')
                                            ->join('tipo_coberturas', 'tipo_coberturas.id', '=', 'cobertura_tipos.cobertura_tipo_id')
                                            ->where('solicitud_cotizacions.id', $solic->id)
                                            ->groupBy('id')
                                            ->get()
                                            ->pluck('name', 'id');
                                    }
                                    /*return SolicitudCotizacion::select('tipo_coberturas.*')
                                    ->join('seguros', 'seguros.id', '=', 'solicitud_cotizacions.seguro_id')
                                    ->join('plans', 'plans.id', '=', 'seguros.plan_id')
                                    ->join('plan_coberturas', 'plan_coberturas.plan_id', '=', 'plans.id')
                                    ->join('coberturas', 'coberturas.id', '=', 'plan_coberturas.cobertura_id')
                                    ->join('cobertura_tipos', 'cobertura_tipos.cobertura_id', '=', 'coberturas.id')
                                    ->join('tipo_coberturas', 'tipo_coberturas.id', '=', 'cobertura_tipos.cobertura_tipo_id')
                                    ->where('solicitud_cotizacions.id','1' )
                                    ->groupBy('id')
                                    ->get()
                                    ->pluck('name', 'id');*/
                                })
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $tipo = CoberturaTipo::where('cobertura_tipo_id', '=', $state)->first();
                                    if ($tipo) {
                                        $limite = Limite::find($tipo->limite_id);
                                        $set('limite', $limite->name);
                                    }
                                }),
                            TextInput::make('limite')->disabled(),
                            Select::make('deducible_id')
                                ->label('Tipo Deducible')
                                ->options(Deducible::query()->pluck('name', 'id'))
                                ->reactive(),
                            TextInput::make('value')
                                ->label('Valor del deducible (%)')
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $deducible = Deducible::find($get('deducible_id'));
                                    if ($deducible && $deducible->id != 3) {
                                        $deducible->value = $state;
                                        $deducible->save();
                                    }
                                    $solici = SolicitudCotizacion::find($get('../../solicitud_id'));
                                    if ($solici) {
                                        $user_vehiculo = UserVehiculo::where('placa', '=', $solici->placa)->first();
                                        if ($user_vehiculo) {
                                            $valor_comercial = (float)$user_vehiculo->valor_comercial;
                                            $new_state=((float)$state/100)*0.08;
                                            $prima_neta = (float)$get('../../prima_neta') + $valor_comercial * $new_state;


                                            $gastos=0.03*$prima_neta;
                                            $valor_prima=$prima_neta+$gastos;
                                            $iva=0.13*$valor_prima;
                                            $precio_prima=$valor_prima+$iva;
                                            $recargo=0.10*$precio_prima;

                                            $prima_neta = sprintf("%.3f", $prima_neta);
                                            $gastos=sprintf("%.3f", $gastos);
                                            $valor_prima=sprintf("%.3f", $valor_prima);
                                            $iva=sprintf("%.3f", $iva);
                                            $precio_prima=sprintf("%.3f", $precio_prima);
                                            $recargo=sprintf("%.3f", $recargo);

                                            $set('../../prima_neta', $prima_neta);
                                            $set('../../gastos', $gastos);
                                            $set('../../total_primas', $valor_prima);
                                            $set('../../iva', $iva);
                                            $set('../../prima_total', $precio_prima);
                                            $set('../../descuento', $recargo);

                                        }
                                    }
                                })
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('solicitud.cliente.name')->sortable()->searchable(),
                TextColumn::make('solicitud.seguro.name')->sortable()->searchable(),
                TextColumn::make('prima_total')->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'no confirmado',
                        'warning' => 'procesando',
                        'success' => fn ($state) => in_array($state, ['confirmado']),
                    ]),
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
            ContratoRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCotizacions::route('/'),
            'create' => Pages\CreateCotizacion::route('/create'),
            'edit' => Pages\EditCotizacion::route('/{record}/edit'),
        ];
    }
}
