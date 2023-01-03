<?php

namespace App\Filament\Widgets;

use App\Models\Facturas;
use App\Models\Pago;
use Carbon\Carbon;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ContratoUser1Chart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'contratoUser1Chart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Pagos x Mes';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $pagos_total=Pago::all();
        $pagos=[];
        foreach($pagos_total as $pag){
            if($pag->factura){
                $pagos[]=$pag;
            }
        }
        //dd($pagos);
        $mes=['Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data=[];
        foreach($mes as $item){
            $contador=0;
            foreach($pagos as $item1){
                $mes_current=(Carbon::parse($item1->date_pay))->format('M');
                //dd(strcmp($mes_current,$item));
                if(strcmp($mes_current,$item)==0){
                    $contador+=1;
                }
            }

            $data[]=$contador;
        }
        //dd($data);
        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => $data,
            'labels' => $mes,
            'legend' => [
                'labels' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ];
    }
}
