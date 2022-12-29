<x-frontend-layout>
    <section class="section-50">
        <div class="container">
            <h3 class="m-b-50 heading-line">Notificationes <i class="fa fa-bell text-muted"></i></h3>

            <div class="notification-ui_dd-content">

                @foreach (auth()->user()->notifications as $notification)
                <div class="notification-list notification-list--unread">
                    <div class="notification-list_content">
                        <div class="notification-list_img">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                              </svg>

                        </div>
                        <div class="notification-list_detail">
                            <p><b>SeguroMotors</b> ha terminado su cotizacion
                                SOL-00{{ json_decode($notification->data['solicitud'])->id }}</p>
                            <p class="text-muted">Tu solicitud fue cotizada exitosamente solicitada en la fecha
                                {{ json_decode($notification->data['solicitud'])->date }}.
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('ver_notification',$notification->id) }}">
                        <div class="notification-list_feature-img" >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                              </svg>

                        </div>
                    </a>
                </div>
                @endforeach

            </div>
            <!--
			<div class="text-center">
				<a href="#!" class="dark-link">Load more activity</a>
			</div>
        -->
        </div>
    </section>
</x-frontend-layout>
