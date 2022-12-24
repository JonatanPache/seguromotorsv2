<div>
    @if(!empty($successMessage))
    <div class="alert alert-success">
        {{ $successMessage }}
    </div>
    @endif

    <div class="text-center">
        <!-- progressbar -->
        <ul class="progressbar">
            <li class="{{ $currentStep != 1 ? '' : 'active' }}">
                <a href="step-1" type="button">Step 1</a>
            </li>
            <li class="{{ $currentStep != 2 ? '' : 'active' }}">
                <a href="step-2" type="button">Step 2</a>
            </li>
            <li class="{{ $currentStep != 3 ? '' : 'active' }}">
                <a href="step-3" type="button" disabled="disabled">
                    Step 3
                </a>
            </li>
        </ul>
    </div>


    <!-- Step 1-->
    <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 1</h3>
                <!-- Seguro --->
                <div class="form-group">
                    <label for="seguro_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                        Selecciona el seguro</label>
                    <select id="seguro_id" wire:model="seguro_id" name="seguro_id"
                        class="bg-gray-50 border border-gray-300
                            text-gray-900 text-sm rounded-lg focus:ring-blue-500
                            focus:border-blue-500 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600
                            dark:placeholder-gray-400 dark:text-white
                            dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Seleccionar seguro</option>
                            @foreach ($seguros as $seguro)
                        <option value="{{ $seguro->id }}" >{{ $seguro->name }}
                            @endforeach
                    </select>
                </div>
                <!-- Prima --->
                <div class="form-group">
                    <label for="prima_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                        Selecciona el tipo de prima</label>
                    <select id="prima_id" wire:model="prima_id" name="prima_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>Seleccionar prima</option>
                        @foreach ($primas as $prima)
                        <option value="{{ $prima->id }}">{{ $prima->name }}
                            @endforeach
                    </select>
                </div>
                <!-- cliente --->
                <div class="form-group">
                    <label for="title">Cliente Name:</label>
                    <input type="text" wire:model="cliente_id" class="form-control" id="taskTitle"
                        placeholder="{{ $user_auth->name }}" value="{{ $user_auth->id }}" disabled>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <!-- conductor --->
                <div class="form-group">
                    <label for="conductor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                        Conductor Name</label>
                    <select id="conductor_id" wire:model="conductor_id" name="conductor_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>Selecciona el conductor</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}
                            @endforeach
                    </select>
                    <a>
                        No esta registrado el conductor?
                        <a href="{{ route('register') }}">Registra aqui.</a>
                    </a>
                </div>
                <!-- placa --->
                <div class="form-group">
                    <label for="placa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                        Placa Vehiculo</label>
                    <select id="placa" wire:model="placa" name="placa"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>Selecciona tu vehiculo</option>
                        @foreach ($placas as $plac)
                        <option value="{{ $plac->placa }}">
                            {{ $plac->placa  }}
                            @endforeach
                    </select>
                    <a>
                        No esta registrado tu vehiculo?
                        <a href="{{ route('register') }}">Registra aqui.</a>
                    </a>
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right"
                    wire:click="firstStepSubmit"
                    type="button">Next
                </button>
                <button class="btn btn-lg bg-accent hover:bg-light-secondary
                    text-black hover:text-light-tail-100 dark:hover:text-white"
                    type="button" onclick=" window.location='{{ route('welcome') }}'" >
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <!-- Step 2 -->
    <div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 2</h3>

                <div class="mt-4">
                    <x-input-label for="image_hist_conduct"
                        :value="__('Hoja de vida del Conductor')" />

                    <x-text-input id="image_hist_conduct"
                        class="block mt-1 w-full" type="file"
                        name="image_hist_conduct" wire:model="image_hist_conduct" />
                </div>

                <div class="mt-4">
                    <x-input-label for="image_hist_auto"
                        :value="__('Historial del vehiculo ')" />

                    <x-text-input id="image_hist_auto"
                        class="block mt-1 w-full" type="file"
                        name="image_hist_auto" wire:model="image_hist_auto"/>
                </div>

                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"
                    wire:click="secondStepSubmit()">Next</button>
                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button"
                    wire:click="back(1)">Back</button>
            </div>
        </div>
    </div>

    <!-- Step 3 -->
    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 3</h3>
                <table class="table">
                    <tr>
                        <td>Cliente Name:</td>
                        <td><strong>{{$cliente_id}}</strong></td>
                    </tr>
                    <tr>
                        <td>Conductor Name:</td>
                        <td><strong>{{$conductor_id}}</strong></td>
                    </tr>
                    <tr>
                        <td>Seguro:</td>
                        <td><strong>{{$seguro_id}}</strong></td>
                    </tr>
                    <tr>
                        <td>Tipo Prima:</td>
                        <td><strong>{{$prima_id}}</strong></td>
                    </tr>
                    <tr>
                        <td>Placa del vehiculo:</td>
                        <td><strong> {{(string)$placa}} </strong></td>
                    </tr>
                </table>
                <button class="btn btn-success btn-lg pull-right"
                    wire:click="submitForm" type="button">Finish!</button>
                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button"
                    wire:click="back(2)">Back</button>
            </div>
        </div>
    </div>

</div>
