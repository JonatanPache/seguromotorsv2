<!DOCTYPE html>
<html>
<head>
    <title>Seguro Motors</title>
    @livewireStyles
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link href="{{ asset('backend/css/wizard.css') }}" rel="stylesheet" id="bootstrap-css">
</head>
<body>
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
</body>
</html>
