<x-frontend-layout>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Solicitud Cotizacion Online
                {{ $user_current->name }}
            </div>
            <div class="card-body">
                <livewire:solicitud-cotizacion-wizard user-id="$user_current" />
            </div>
        </div>
    </div>
@livewireScripts
</x-frontend-layout>
