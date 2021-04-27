<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SellerOrderAutoCancelConfirmation extends Notification implements ShouldQueue
{
    use Queueable;
    public $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->error()
                    ->markdown('emails.seller.confirm', ['order' => $this->order])
                    ->subject('Pesanan Telah Batal Otomatis: "' . $this->order['products']['jasa_name'] . '"')
                    ->greeting('Hai ' .  $this->order['products']['products']['seller']['name'] . ',')
                    ->line('Aww pesanannya batal otomatis nihm karena batas waktu yang ditentuin dah habis')
                    ->line('Di bawah ini detail pesanannya ya')
                    ->action('Lihat Detail', url('/notifications/pembatalan'))
                    ->line('Lain kali tetep waspada sama batas waktu ya :(');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
