<x-frontend-layout>

    <div class="container-fluid">
    <div class="container">
        <!-- Title -->
        <div class="d-flex justify-content-between align-items-center py-3">
          <h2 class="h5 mb-0"><a href="#" class="text-muted">
            </a> Solicitud SOL-00{{ json_decode($noti[0]->data['solicitud'])->id }}
        </h2>
        </div>

        <!-- Main content -->
        <div class="row">
          <div class="col-lg-8">
            <!-- Details -->
            <div class="card mb-4">
              <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                  <div>
                    <span class="me-3">Vigencia desde el : {{ json_decode($noti[0]->data['solicitud'])->date }}</span>
                    <span class="me-3">Hasta el : {{ $cotizacion->date_end }}</span>
                    <!--
                    <span class="me-3">#16123222</span>
                    <span class="me-3">Visa -1234</span>
                    -->
                    <span class="badge rounded-pill bg-info">Cotizado</span>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text">
                        <i class="bi bi-download"></i>
                        <span class="text">Deducible</span></button>
                    <div class="dropdown">
                      <button class="btn btn-link p-0 text-muted" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-printer"></i> Print</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <table class="table table-borderless">
                  <tbody>
                    @foreach ($tipos as $tipo)
                    <tr>
                        <td>
                            <div class="d-flex mb-2">
                              <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>

                              </div>
                              <div class="flex-lg-grow-1 ms-3">
                                <h6 class="small mb-2"><a class="text-reset">
                                    {{ $tipo->tipoCobertura->name }}</a>
                                </h6>
                                <!--
                                <span class="small">Color: Black</span>
                                -->
                            </div>
                            </div>
                          </td>
                      <td>1</td>
                      <td class="text-end">{{ $tipo->deducible->value }}%</td>
                    </tr>
                    @endforeach


                  </tbody>
                  <tfoot>

                    <tr>
                      <td colspan="2">Prima Neta</td>
                      <td class="text-end">{{ $cotizacion->prima_neta }}</td>
                    </tr>
                    <tr>
                      <td colspan="2">Gastos de Expedicion</td>
                      <td class="text-end">{{ $cotizacion->gastos }}</td>
                    </tr>
                    <tr>
                      <td colspan="2">IVA(13%)</td>
                      <td class="text-danger text-end">{{ $cotizacion->iva }}</td>
                    </tr>
                    <tr class="fw-bold">
                      <td colspan="2">Precio de la Prima</td>
                      <td class="text-end">{{ $cotizacion->prima_total }}</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <!-- Payment -->
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <h3 class="h6">Para Confirmar la cotizacion dirigase:</h3>
                    <address>
                      <strong>Santa Cruz de la Sierra</strong><br>
                      Av. Saone<br>
                      Edificio #23<br>
                      <abbr title="Phone">P:</abbr> (33) 333-352
                    </address>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <!-- Customer Notes -->
            <div class="card mb-4">
              <div class="card-body">
                <h3 class="h6">Customer Notes</h3>
                <p>Sed enim, faucibus litora velit vestibulum habitasse. Cras lobortis cum sem aliquet mauris rutrum. Sollicitudin. Morbi, sem tellus vestibulum porttitor.</p>
              </div>
            </div>
            <div class="card mb-4">
              <!-- Shipping information -->
              <div class="card-body">
                <h3 class="h6">Shipping Information</h3>
                <strong>FedEx</strong>
                <span><a href="#" class="text-decoration-underline" target="_blank">FF1234567890</a> <i class="bi bi-box-arrow-up-right"></i> </span>
                <hr>
                <h3 class="h6">Address</h3>
                <address>
                  <strong>John Doe</strong><br>
                  1355 Market St, Suite 900<br>
                  San Francisco, CA 94103<br>
                  <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
              </div>
            </div>

            <div class="card mb-4">
              <!-- Shipping information -->
              <div class="card-body">
                <h3 class="h6">Contrato</h3>
                <strong>SeguroMotors</strong>
                <span>
                  <a  class="text-decoration-underline" target="_blank">
                    COT-00{{ $cotizacion->id }}</a>
                    <i class="bi bi-box-arrow-up-right"></i>
                </span>
                <hr>
                <a href="{{ route('contrato',$cotizacion->id) }}">
                  <button type="button">
                    Seguir en el contrato
                  </button>
                </a>
              </div>


            </div>

          </div>
        </div>
      </div>
    </div>
    </x-frontend-layout>
