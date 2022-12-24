<?php

namespace App\Http\Livewire;

use App\Models\Prima;
use App\Models\Seguro;
use App\Models\SolicitudCotizacion;
use App\Steps\DocumentConductorStep;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Vildanbina\LivewireWizard\WizardComponent;

class SolicitudCotizacionWizard extends Component
{
    use WithFileUploads;
    public $currentStep = 1;
    public $seguro_id;
    public $cliente_id;
    public $conductor_id;
    public $prima_id;
    public $placa;
    public $image_hist_conduct;
    public $image_hist_auto;
    public $status;
    public $successMessage = '';
    public SolicitudCotizacion $solicitud;


    public function render()
    {

        $user_auth = Auth::user();
        $user_id = $user_auth->id;
        $cliente_id = $user_id;
        $users = DB::table('users')   // rol_id=1 is admin
            ->whereNotIn('rol_id', [1])
            ->get();
        $seguros = Seguro::all();
        $primas = Prima::all();
        $placas = DB::table('user_vehiculos')
            ->where('user_id', $user_id)
            ->get();
        return view(
            'livewire.solicitud-cotizacion-wizard',
            compact('users', 'user_auth', 'seguros', 'primas', 'placas')
        );
    }

    public function model(): SolicitudCotizacion
    {
        return new SolicitudCotizacion();
    }

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'seguro_id' => '',
            'cliente_id' => '',
            'conductor_id' => '',
            'prima_id' => '',
            'placa' => '',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'image_hist_conduct' => '',
            'image_hist_auto' => '',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm()
    {
        $conduct_name = 'img_conduc' . time() . $this->image_hist_conduct->getClientOriginalName();
        $auto_name = 'img_auto' . time() . $this->image_hist_auto->getClientOriginalName();
        $upload_cond = Storage::disk('public2')->put('img_historiales',$this->image_hist_conduct);
        $upload_auto = Storage::disk('public2')->put('img_historiales',$this->image_hist_auto);
        if ($upload_auto) {
            SolicitudCotizacion::create([
                'date' => Carbon::now()->toDateString(),
                'seguro_id' => $this->seguro_id,
                'cliente_id' => Auth::user()->id,
                'conductor_id' => $this->conductor_id,
                'prima_id' => $this->prima_id,
                'placa' => $this->placa,
                'image_hist_conduc' => $upload_cond,
                'image_hist_auto' => $upload_auto,
            ]);
        }

        $this->successMessage = 'Solicitud enviada exitosamente. Favor espere dentro de horas en recibir su Cotizacion.';

        $this->clearForm();

        $this->currentStep = 1;


    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function clearForm()
    {
        $this->seguro_id = '';
        $this->cliente_id = '';
        $this->conductor_id = '';
        $this->prima_id = '';
        $this->placa = '';
        $this->image_hist_auto = '';
        $this->image_hist_conduct = '';
    }
}
