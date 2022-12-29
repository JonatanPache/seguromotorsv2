<x-frontend-layout>
    <section class="front">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="front-invoice-wrapper">
						<div class="front-invoice-top">
							<div class="row">
								<div class="col-sm-6">
									<div class="front-invoice-top-left">
										<h2>SeguroMotors</h2>
										<h3>Santa Cruz de la Sierra</h3>
										<h5>Bolivia</h5>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="front-invoice-top-right">
										<h2> CON-00{{ $contrato->id }}</h2>
										<h3>{{ $contrato->date_start }}</h3>
										<!--
                                        <h5></h5>
                                        -->
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-xs-12">
									<h1 class="service-name">Contrato de Seguro</h1>
									<!--
                                    <h6 class="date">September 06, 2017</h6>
                                    -->
								</div>
							</div>
						</div>
						<div class="front-invoice-bottom">
							<div class="row">
								<div class="col-xs-12">
									<p class="description">
                                        SEGUROMOTORS SA DENOMINADA EN ADELANTE "LA COMPANIA", ASEGURA DE ACUERDO CON LAS CONDICIONES GENERALES Y ESPECIALES DE ESTA POLIZA A LA PERSONA FISICA O MORAL DENOMINADA EN ADELANTE "EL ASEGURADO"
                                    </p>

								</div>
								<div class="col-xs-12 col-sm-10 col-md-9">
									<h6 class="specs">Informacion General:</h6>
                                    <table class="table borderless custom-table">
										<tbody>
											<tr>
												<td>Vigencia desde:</td>
												<td>{{ $contrato->date_start }}</td>
											</tr>
											<tr>
												<td>Hasta el:</td>
												<td>{{ $contrato->date_end }}</td>
											</tr>
											<tr>
												<td>Tipo Documento:</td>
												<td>Poliza</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="col-xs-12 col-sm-10 col-md-9">
									<h6 class="specs">Contratante:</h6>
                                    <table class="table borderless custom-table">
										<tbody>
											<tr>
												<td>Nombre :</td>
												<td>{{ $cotizacion->solicitud->cliente->name }}, {{ $cotizacion->solicitud->cliente->last_name }} </td>
											</tr>
											<tr>
												<td>Direccion :</td>
												<td>{{ $cotizacion->solicitud->cliente->address }}</td>
											</tr>
											<tr>
												<td>Cuidad :</td>
												<td>{{ $cotizacion->solicitud->cliente->city->name}}</td>
											</tr>
										</tbody>
									</table>
								</div>

                                <div class="col-xs-12 col-sm-10 col-md-9">
									<h6 class="specs">Conductor Habitual:</h6>
                                    <table class="table borderless custom-table">
										<tbody>
											<tr>
												<td>Nombre :</td>
												<td>{{ $cotizacion->solicitud->conductor->name }}, {{ $cotizacion->solicitud->conductor->last_name }} </td>
											</tr>
											<tr>
												<td>Direccion :</td>
												<td>{{ $cotizacion->solicitud->conductor->address }}</td>
											</tr>
											<tr>
												<td>Cuidad :</td>
												<td>{{ $cotizacion->solicitud->conductor->city->name}}</td>
											</tr>
										</tbody>
									</table>
								</div>

                                <div class="col-xs-12 col-sm-10 col-md-9">
									<h6 class="specs">Conceptos Economicos:</h6>
                                    <table class="table borderless custom-table">
										<tbody>
											<tr>
												<td>Forma De Pago :</td>
												<td>{{ $cotizacion->solicitud->prima->description }}</td>
											</tr>
											<tr>
												<td>Moneda :</td>
												<td> $ USD</td>
											</tr>
											<tr>
												<td>Recargo Financiero :</td>
												<td>{{ $cotizacion->descuento}}</td>
											</tr>
                                            <tr>
												<td>Prima Neta :</td>
												<td>{{ $cotizacion->prima_neta}}</td>
											</tr>
                                            <tr>
												<td>Gastos De Expedicion :</td>
												<td>{{ $cotizacion->gastos}}</td>
											</tr>
                                            <tr>
												<td>IVA (13%) :</td>
												<td>{{ $cotizacion->iva}}</td>
											</tr>
                                            <tr>
												<td>Prima Total :</td>
												<td>{{ $cotizacion->prima_total}}</td>
											</tr>
										</tbody>
									</table>
								</div>

                                <div class="col-xs-12">
									<p class="description">
                                        EN CUMPLIMIENTO A LO DISPUESTO EN EL ARTICULO 202 DE LA LEY
                                        DE INSTITUCIONES DE SEGUROS Y FIANZAS. LA DOCUMENTACION
                                        CONTRACTAL Y LA NOTA TECNICA QUE INTEGRAN ESTE QUEDARAN
                                        REGISTRADAS ANTE LA COMISION NACIONAL DE SEGUROS Y FIANZAS A
                                         PARTIR DEL DIA {{ $contrato->date_start }} CON EL NUMERO
                                         CON-00{{$contrato->id  }}.
                                    </p>

                                    <p class="description">
                                        ESTA POLIZA NO ES COMPROBANTE DE PAGO, EXIJA SU RECIBO AL LIQUIDAR LA PRIMA.
                                    </p>

                                    <p class="description">
                                        EN TESTIMONIO, SE REQUIRE LA FIRMA DEL ASEGURADO POR FAVOR
                                        FIRMA DEBAJO.
                                    </p>
                                    <div class="card">
                                        <div class="card-body">
                                            @if (session('success'))
                                                <div class="alert alert-success">
                                                    <span>{{ session('success') }}</span>
                                                </div>
                                            @endif
                                            <form method="POST" action="{{ route('contrato_firma',$contrato->id) }}">
                                                @csrf
                                                <div class="col-md-12">
                                                    <label>Firma Digital:</label>
                                                    <br/>
                                                    <div id="sig"></div>
                                                    <br/><br/>
                                                    <button id="clear" class="btn btn-danger btn-sm">Clear</button>
                                                    <textarea id="signature" name="signed" style="display: none"></textarea>
                                                </div>
                                                <br/>
                                                <div class="col-md-6 offset-md-3 mt-5">
                                                    <button class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
								</div>

                                <div class="container">
                                    <div class="row">

                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>

    <script type="text/javascript">
        var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
        $('#clear').click(function (e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
</x-frontend-layout>
