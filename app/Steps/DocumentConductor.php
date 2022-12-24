<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;
use Illuminate\Validation\Rule;

class DocumentConductorStep extends Step
{
    // Step view located at resources/views/steps/general.blade.php
    protected string $view = 'components.frontend.solicitud.document-step';

    /*
     * Initialize step fields
     */
    public function mount()
    {
        $this->mergeState([
            'date'                  => $this->model->date,
        ]);
    }

    /*
     * Step Title
     */
    public function title(): string
    {
        return __('General');
    }
}
