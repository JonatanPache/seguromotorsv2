<?php

namespace App\Filament\Widgets;

use App\Models\Contrato;
use App\Models\User;
use Carbon\Carbon;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ContratoUserChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'contratoUserChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Contratos x Mes';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $contratos_all=Contrato::all();
        /*
        $pago=[];
        foreach($pagos_total as $pag){
            if($pag->factura){
                $pagos[]=$pag;
            }
        }*/
        //dd($pagos);
        $mes=['Sep', 'Oct', 'Nov', 'Dec','Jan'];
        $data=[];
        foreach($mes as $item){
            $contador=0;
            foreach($contratos_all as $item1){
                $mes_current=(Carbon::parse($item1->date_pay))->format('M');
                //dd(strcmp($mes_current,$item));
                if(strcmp($mes_current,$item)==0){
                    $contador+=1;
                }
            }

            $data[]=$contador;
        }
        return [
            'chart' => [
                'type' => 'area',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'BasicAreaChart',
                    'data' => $data,
                ],
            ],
            'xaxis' => [
                'categories' => $mes,
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ]
        ];
    }
}
