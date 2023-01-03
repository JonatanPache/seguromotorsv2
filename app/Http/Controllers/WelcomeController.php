<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Cotizacion;
use App\Models\CotizacionDeducible;
use App\Models\Facturas;
use App\Models\Pago;
use App\Models\Seguro;
use App\Models\SolicitudCotizacion;
use App\Models\User;
use App\Models\Vehiculo;
use App\Notifications\UserCotizacionNotification;
use Carbon\Carbon;
use Exception;
use Filament\Forms\Components\View;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Stripe\Charge;
use Stripe\Stripe;
use Session;
use Stripe\BillingPortal\Session as BillingPortalSession;
use Stripe\Checkout\Session as CheckoutSession;
use Stripe\Customer;
use Stripe\FinancialConnections\Session as FinancialConnectionsSession;
use Symfony\Component\HttpFoundation\Session\Session as HttpFoundationSessionSession;
use Barryvdh\DomPDF\Facade\Pdf as Pdf;
use Illuminate\Support\Facades\App;

use function Clue\StreamFilter\append;

class WelcomeController extends Controller
{




    public function __invoke()
    {
        $skills = Seguro::all();
        $projects = Vehiculo::all();
        return view('welcome', compact('skills', 'projects'));
    }

    public function notify()
    {
        if (auth()->user()) {
            $user = User::first();
            //auth()->user()->notify(new UserCotizacionNotification($user));
        }
    }

    public function index_notifications()
    {
        return view('notifications');
    }

    public function show_notification($id)
    {

        if ($id) {
            $noti = auth()->user()->notifications->where('id', $id);
            $id_sol = json_decode($noti[0]->data['solicitud'])->id;
            $cotizacion = Cotizacion::where('solicitud_id', '=', $id_sol)->first();
            $tipos = CotizacionDeducible::all()->where('cotizacion_id', '=', $cotizacion->id);
            return view('noti_solicitud.index', compact('noti', 'tipos', 'cotizacion'));
        }
    }

    public function contrato($id)
    {
        $contrato = Contrato::where('cotizacion_id', '=', $id)->first();
        $cotizacion = Cotizacion::where('id', '=', $id)->first();
        return view('contrato', compact('contrato', 'cotizacion'));
    }

    public function contrato_firma(Request $request, $id)
    {
        $folderPath = public_path('storage/signatures/');
        $image = explode(";base64,", $request->signed);
        $image_type = explode("image/", $image[0]);
        $image_type_png = $image_type[1];
        $image_base64 = base64_decode($image[1]);
        $file_upload = uniqid() . '.' . $image_type_png;
        $file = $folderPath . $file_upload;
        file_put_contents($file, $image_base64);
        $contrato = Contrato::find($id);
        $contrato->cliente_firm = 'signatures/' . $file_upload;
        $contrato->save();
        return back()->with('success', 'Contrato firmado exitosamente !!');
    }

    public function pagos_index()
    {
        $user = auth()->user();
        $pagos = Pago::all()->where('cliente_id', '=', $user->id);
        $now = (Carbon::now()->month(16));  //->month(15)
        $pagos_send = array();
        $pagosFin=array();
        $total = 0;
        $recargo = 0;
        if ($pagos) {
            foreach ($pagos as $pago) {
                //dd($pago->factura->id);
                if($pago->factura){
                    $pagosFin[]=$pago;
                }else{
                    $month_current = Carbon::parse($pago->date);
                    if ($month_current < $now) {
                        $total += $pago->total;
                        $pagos_send[] = $pago;
                    }
                }

            }
            if (count($pagos_send) > 1) {
                $soli = (SolicitudCotizacion::all()->where('cliente_id', '=', $user->id)->first());
                $cotizaciones = Cotizacion::all()->where('solicitud_id', '=', $soli->id);
                foreach ($cotizaciones as $coti) {
                    if (Contrato::all()->where('cotizacion_id', '=', $coti->id)) {
                        $recargo = $coti->descuento;
                    }
                }
                foreach ($pagos_send as $pago) {
                    $pago_current = Pago::find($pago->id);
                    $pago_current->recargo_financiero = $recargo;
                    $pago_current->save();
                }
            }
        }else{
            return view('welcome');
        }

        $recargo_total = count($pagos_send) * $recargo;
        //dd($pagosFin);
        return view('pagos', compact('pagos_send', 'recargo', 'recargo_total', 'total','pagosFin'));
    }

    public function pagos_store(Request $request)
    {
        //dd($request->all());
        if ($request->total != 0) {
            $facturas = array();
            $pagos_decode = json_decode($request->pagos_object);
            $total_base = $request->total;
            foreach ($pagos_decode as $pago) {
                $factura = Facturas::create([
                    'number' => 'FAC-00' . $pago->id,
                    'description' => 'Esta factura es cancelado por el cliente ' . auth()->user()->name .
                        ' con numero de CI ' . auth()->user()->ci . ' a cuase del pago de seguro con numero ' . $pago->id,
                    'pago_id' => $pago->id,
                    'total_pagado' => '0'
                ]);
                $facturas[] = $factura;
            }
            //dd($facturas);
            return view('checkout', compact('total_base', 'facturas', 'pagos_decode'));
        }
        return redirect()->back();
    }

    public function pagos_pay(Request $request)
    {
        $stripe = new \Stripe\StripeClient("sk_test_51MJNScFW6Pgubl3xhwRRNL4VXmOhpy4EUoh6PkhglrxENfJzp2c1dBAWMntClEOgRcI8gG1quImAE5fKYHkAncsu00MDevVs9o");
        $res = $stripe->tokens->create([
            'card' => [
                'number' => $request->cardnumber,
                'exp_month' => $request->month,
                'exp_year' => $request->year,
                'cvc' => $request->cvc,
            ],
        ]);
        //dd($request->all());
        \Stripe\Stripe::setApiKey("sk_test_51MJNScFW6Pgubl3xhwRRNL4VXmOhpy4EUoh6PkhglrxENfJzp2c1dBAWMntClEOgRcI8gG1quImAE5fKYHkAncsu00MDevVs9o");
        //dd(round($request->total));
        $response = $stripe->charges->create([
            "amount" => (int)round($request->total)+1,
            "currency" => 'usd',
            "description" => 'pago poliza',
            "source" => $res->id
        ]);
        //dd($response);
        if ($response) {
            foreach (json_decode($request->facturas) as $fact) {
                $pago = Pago::find($fact->pago_id);
                $pago->date_pay = Carbon::now();
                $pago->save();
                $fact_current = Facturas::find($fact->id);
                $fact_current->total_pagado = $pago->total + $pago->recargo_financiero;
                $fact_current->save();
            }
            return view('pagos',['pagos_send'=>null])->with('success', 'Pago exitosamente!');
        } else {
            return back()->with('error', 'Hubo error');
        }
    }

    public function factura_generate($id)
    {
        $pago=Pago::find($id);
        $cliente=User::find($pago->cliente->id);

        if($pago && $cliente){
            $factura=Facturas::find($pago->factura->id);
            $data=['factura'=>$factura];
            //$pdf=Pdf::loadView('facturas.generate',$data);
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('facturas.generate',$data);
            return $pdf->stream();
            //return $pdf->download('factura.pdf');
            //return view('facturas.generate',compact('factura'));
        }
        return back();

    }

    public function factura_ver($id)
    {
        $pago=Pago::find($id);
        $cliente=User::find($pago->cliente->id);

        if($pago && $cliente){
            $factura=Facturas::find($pago->factura->id);
            return view('facturas.generate',compact('factura'));
        }
        return back();

    }
}
