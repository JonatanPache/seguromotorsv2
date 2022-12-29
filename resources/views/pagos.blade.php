<x-frontend-layout>

    <div class="card ">
        <div class="row">
            <div class="col-md-8 cart">

                @if ($message = Session::get('success'))
                <div class="alert alert-success  alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif

                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Tus Pagos</b></h4>
                        </div>
                        @if ($pagos_send!=null)
                        <div class="col align-self-center text-right text-muted">{{ count($pagos_send)}} Items</div>
                        @else
                        <div class="col align-self-center text-right text-muted"> 0 Items</div>
                        @endif

                    </div>
                </div>

                @if($pagos_send!=null)
                @foreach ($pagos_send as $pago)
                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>
                        </div>
                        <div class="col">
                            <div class="row text-muted">POL-00{{ $pago->poliza->id }}</div>
                            <div class="row">{{ $pago->poliza->cotizacion->solicitud->seguro->name }}</div>
                        </div>
                        <div class="col">
                            <a class="bold">{{DateTime::createFromFormat('Y-m-d', $pago->date)->format('d F Y') }}</a>
                        </div>
                        <div class="col" name="recargo" id="recargo">&dollar; {{ $recargo }}</div>

                        <div class="col" name="pago" id="pago">&dollar; {{ $pago->total }} <span
                                class="close">&#10005;</span></div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>
                        </div>
                        <div class="col">
                            <div class="row text-muted"> </div>
                            <div class="row"> No tienes ningun pago pendiente.</div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="back-to-shop"><a href="{{ route('welcome') }}">&leftarrow;</a><span
                        class="text-muted">Regresar</span></div>
            </div>
                <div class="col-md-4 summary">
                    <div>
                        <h5><b>Lista</b></h5>
                    </div>
                    <hr>
                    <div class="row">
                        @if ($pagos_send!=null)
                        <div class="col" style="padding-left:0;"> Items {{ count($pagos_send) }} </div>
                        <div class="col text-right" name='total' id="total">&dollar; {{$total}} </div>
                        @else
                        <div class="col" style="padding-left:0;"> Items 0 </div>
                        <div class="col text-right" name='total' id="total">&dollar; 0 </div>
                        @endif
                    </div>
            @if($pagos_send!=null)
            <form id="pagos" role="form" method="post" action="{{ route('checkout') }}">
                @csrf
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">Recargo Financiero </div>
                        <div class="col text-right">&dollar; {{ $recargo_total }}</div>
                        <input type="hidden" id="recargo" name="recargo" value="{{ $recargo_total }}">
                    </div>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL </div>
                        <div class="col text-right">&dollar; {{ (float)($recargo_total)+(float)($total) }}</div>

                        <input id="total" name="total" type="hidden" value="{{ (float)($recargo_total)+(float)($total) }}">
                    </div>

                    <input required="true" id="pagos_object" name="pagos_object" type=hidden value="{{ json_encode($pagos_send) }}">
                    <a >
                        <button type="submit" class="btn">CHECKOUT</button>
                    </a>
                </form>
                @endif
            </div>


        </div>
    </div>
    <br>
    <div class="card ">
    <div class="row">
        <div class="col-md-12 cart">

            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Ultimos Pagos</b></h4>
                    </div>
                    @if ($pagosFin!=null)
                    <div class="col align-self-center text-right text-muted">{{ count($pagosFin)}} Items</div>

                    @else
                    <div class="col align-self-center text-right text-muted"> 0 Items</div>
                    @endif

                </div>
            </div>

            @if($pagosFin!=null && count($pagosFin) > 0)
            @foreach ($pagosFin as $pago)
                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>
                        </div>
                        <div class="col">
                            <div class="row text-muted">POL-00{{ $pago->poliza->id }}</div>
                            <div class="row">{{ $pago->poliza->cotizacion->solicitud->seguro->name }}</div>
                        </div>
                        <div class="col">
                            <a class="bold">{{DateTime::createFromFormat('Y-m-d', $pago->date)->format('d F Y') }}</a>
                        </div>
                        <div class="col">
                            <a class="bold">{{DateTime::createFromFormat('Y-m-d', $pago->date_pay)->format('d F Y') }}</a>
                        </div>
                        <div class="col" name="pago" id="pago">&dollar; {{ $pago->total + $pago->recargo_financiero }}</div>

                    </div>
                </div>
                @endforeach
            @else
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                        </svg>
                    </div>
                    <div class="col">
                        <div class="row text-muted"></div>
                        <div class="row"> Todavia no has hecho ningun pago</div>
                </div>
            </div>
            @endif
        </div>
    </div>
    </div>

    <style>
        .title {
            margin-bottom: 5vh;
        }

        .card {
            margin: auto;
            max-width: 950px;
            top: 20px;
            width: 90%;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 1rem;
            border: transparent;
        }

        @media(max-width:767px) {
            .card {
                margin: 3vh auto;
            }
        }

        .cart {
            background-color: #fff;
            padding: 4vh 5vh;
            border-bottom-left-radius: 1rem;
            border-top-left-radius: 1rem;
        }

        @media(max-width:767px) {
            .cart {
                padding: 4vh;
                border-bottom-left-radius: unset;
                border-top-right-radius: 1rem;
            }
        }

        .summary {
            background-color: #ddd;
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
            padding: 4vh;
            color: rgb(65, 65, 65);
        }

        @media(max-width:767px) {
            .summary {
                border-top-right-radius: unset;
                border-bottom-left-radius: 1rem;
            }
        }

        .summary .col-2 {
            padding: 0;
        }

        .summary .col-10 {
            padding: 0;
        }

        .row {
            margin: 0;
        }

        .title b {
            font-size: 1.5rem;
        }

        .main {
            margin: 0;
            padding: 2vh 0;
            width: 100%;
        }

        .col-2,
        .col {
            padding: 0 1vh;
        }

        a {
            padding: 0 1vh;
        }

        .close {
            margin-left: auto;
            font-size: 0.7rem;
        }

        img {
            width: 3.5rem;
        }

        .back-to-shop {
            margin-top: 4.5rem;
            top: bottom;
        }

        h5 {
            margin-top: 4vh;
        }

        hr {
            margin-top: 1.25rem;
        }

        form {
            padding: 2vh 0;
        }

        select {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1.5vh 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        input {
            border: 1px solid rgba(0, 0, 0, 0.137);
            padding: 1vh;
            margin-bottom: 4vh;
            outline: none;
            width: 100%;
            background-color: rgb(247, 247, 247);
        }

        input:focus::-webkit-input-placeholder {
            color: transparent;
        }

        .btn {
            background-color: #000;
            border-color: #000;
            color: white;
            width: 100%;
            font-size: 0.7rem;
            margin-top: 4vh;
            padding: 1vh;
            border-radius: 0;
        }

        .btn:focus {
            box-shadow: none;
            outline: none;
            box-shadow: none;
            color: white;
            -webkit-box-shadow: none;
            -webkit-user-select: none;
            transition: none;
        }

        .btn:hover {
            color: white;
        }

        a {
            color: black;
        }

        a:hover {
            color: black;
            text-decoration: none;
        }

        #code {
            background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
            background-repeat: no-repeat;
            background-position-x: 100%;
            background-position-y: center;
        }
    </style>

</x-frontend-layout>
