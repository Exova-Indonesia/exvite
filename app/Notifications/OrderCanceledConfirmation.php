<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCanceledConfirmation extends Notification implements ShouldQueue
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
                    ->markdown('emails.buyer.confirm', ['order' => $this->order])
                    ->subject('Pesanan Telah Dibatalkan: "' . $this->order['products']['jasa_name'] . '"')
                    ->greeting('Hai ' . $this->order['customer']['name'] . ',')
                    ->line('Pesanan udah berhasil kamu batalin')
                    ->line('Kamu bisa memesan lagi ataupun menarik dana refund yang telah masuk di Exova Wallet kamu ya')
                    ->line('Di bawah ini detail pesanan kamu ya')
                    ->action('Lihat Detail', url('/notifications/pembatalan'))
                    ->line('Yang sabar ya mungkin belum jodoh :)')
                    ->line('Yuk cari yang lain lagi yang pas buat kamu');
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
