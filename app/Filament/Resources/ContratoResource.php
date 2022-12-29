<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContratoResource\Pages;
use App\Filament\Resources\ContratoResource\RelationManagers;
use App\Models\Contrato;
use App\Models\Cotizacion;
use App\Models\Pago;
use App\Models\Poliza;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class ContratoResource extends Resource
{
    protected static ?string $model = Contrato::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Card::make()->schema([
                        Select::make('cotizacion_id')
                            ->relationship('cotizacion', 'id')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $coti = Cotizacion::find($state);
                                $set('name', $state);
                                $set('user_id', User::find($coti->solicitud->cliente->id)->id);
                                $set('date_start', $coti->date_start);
                                $set('date_end', $coti->date_end);
                            }),
                        TextInput::make('user_id')
                            ->label('Cliente Name')
                            ->disabled(),
                        TextInput::make('date_start'),
                        TextInput::make('date_end'),
                        Select::make('status')
                            ->options([
                                'new' => 'New',
                                'processing' => 'Processing',
                                'up' => 'Up',
                                'down' => 'Down',
                                'cancelled' => 'Cancelled',
                            ])
                            ->reactive()
                            ->afterStateUpdated(function (callable $get, $state, callable $set) {
                                if ($state == 'processing') {
                                    $coti = Cotizacion::find($get('cotizacion_id'));
                                    if ($coti) {
                                        $poliza = Poliza::create([
                                            'detalle' => 'cotizacion prueba',
                                            'cotizacion_id' => $coti->id,
                                            'user_id' => User::find(($coti->solicitud->cliente)->id)->id,
                                            'duracion' => Carbon::parse($get('date_start'))->diffInDays(Carbon::parse($get('date_end'))),
                                            'date_start' => $get('date_start'),
                                            'date_end' => $get('date_end'),
                                        ]);
                                    }
                                }
                                if($state=='up'){
                                    $coti_1= Cotizacion::find($get('cotizacion_id'));
                                    if($coti_1){
                                        $days=Carbon::parse($get('date_start'))->diffInDays(Carbon::parse($get('date_end')));
                                        $meses=($days/30)-1;
                                        $poliza_id=Poliza::where('cotizacion_id','=',$coti_1->id)->first();
                                        $cliente_id=$coti_1->solicitud->cliente->id;
                                        $dias_plazo=$coti_1->solicitud->prima->plazo_baja;
                                        $date_init=Carbon::parse($coti_1->Date_start);
                                        for($i=0;$i<$meses;$i++ ){
                                            Pago::create([
                                                'poliza_id'=>$poliza_id->id,
                                                'cliente_id'=>$cliente_id,
                                                'date'=>$date_init->addMonth(),
                                                'date_pay'=>'',
                                                'otros_pagos'=>'',
                                                'total'=>$coti_1->total_primas,
                                                'dias_plazos'=>$dias_plazo,
                                                'recargo_financiero'=>'0',
                                            ]);
                                        }
                                    }

                                }
                            }),
                        FileUpload::make('cliente_firm'),
                        TextInput::make('preposicion'),

                    ])->columns(2),

                    Repeater::make('contratoPoliza')
                        ->relationship()
                        ->schema([
                            Select::make('poliza_id')
                                ->label('Poliza Number')
                                ->reactive()
                                ->options(function (callable $get) {
                                    $id_cot = $get('../../cotizacion_id');

                                    return Poliza::where('cotizacion_id', '=', $id_cot)
                                        ->get()
                                        ->pluck('id', 'id');
                                })
                                ->afterStateUpdated(function (callable $get, callable $set, $state) {
                                    $id_cot = $get('../../cotizacion_id');
                                    $coti = Cotizacion::find($id_cot);
                                    $set('prima_total', $coti->total_primas);
                                })
                                ->columnSpan([
                                    'md' => 5,
                                ]),

                            Forms\Components\TextInput::make('prima_total')
                                ->numeric()
                                ->default(1)
                                ->columnSpan([
                                    'md' => 2,
                                ])
                                ->required(),
                        ])
                ])->default(1)
                    ->columnSpan(['lg' => fn (?Contrato $record) => $record === null ? 3 : 2]),

                Card::make()->schema([
                    Placeholder::make('created_at')
                        ->label('Created at')
                        ->content(fn (Contrato $record): ?string => $record->created_at?->diffForHumans()),

                    Placeholder::make('updated_at')
                        ->label('Last modified at')
                        ->content(fn (Contrato $record): ?string => $record->updated_at?->diffForHumans()),
                ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Contrato $record) => $record === null),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('description')->sortable()->searchable(),
                TextColumn::make('user.name')->sortable()->searchable(),
                TextColumn::make('seguro.name')->sortable()->searchable(),
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
            'index' => Pages\ListContratos::route('/'),
            'create' => Pages\CreateContrato::route('/create'),
            'edit' => Pages\EditContrato::route('/{record}/edit'),
        ];
    }
}
