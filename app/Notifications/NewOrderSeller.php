<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderSeller extends Notification implements ShouldQueue
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
                    ->markdown('emails.seller.neworder', ['order' => $this->order])
                    ->subject('Pesanan Baru Untuk ' . $this->order['products']['products']['seller']['name'])
                    ->greeting('Hai ' . $this->order['products']['products']['seller']['name'] . ',')
                    ->line('Asikk pesanan baru masuk nih, detailnya udah Kami lampirkan di bawah ya')
                    ->action('Terima Pesanan', url('/notifications/penjualan'))
                    ->line('Yuk jangan buat klien Kamu nunggu lama!. Nunggu itu gak enak lho :(');
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
