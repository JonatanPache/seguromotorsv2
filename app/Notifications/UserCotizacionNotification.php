<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCotizacionNotification extends Notification
{
    use Queueable;
    public $user;
    public $solicitud_cliente;
    public $cotizacion;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$solicitud_cliente,$cotizacion)
    {
        $this->user = $user;
        $this->solicitud_cliente = $solicitud_cliente;
        $this->cotizacion = $cotizacion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {

        return [
            'user'=>json_encode($this->user),
            'solicitud'=>json_encode($this->solicitud_cliente),
            'cotizacion'=>json_encode($this->cotizacion)
        ];
    }
}
