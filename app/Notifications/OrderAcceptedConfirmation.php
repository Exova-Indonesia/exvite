<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderAcceptedConfirmation extends Notification implements ShouldQueue
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
                    ->markdown('emails.buyer.confirm', ['order' => $this->order])
                    ->subject('Pesanan Diterima: "' . $this->order['products']['jasa_name'] . '"')
                    ->greeting('Hai ' . $this->order['customer']['name'] . ',')
                    ->line('Asikk pesanan kamu diterima nih, Nanti kalau pesanan kamu gak selesai sesuai deadline yang kamu atur, pesanan kamu akan batal otomatis dan uang kamu langsung masuk Exova Wallet kamu ya')
                    ->line('Di bawah ini detail pesanan kamu ya')
                    ->action('Lihat Detail', url('/notifications/pembelian'))
                    ->line('Tunggu yang sabar ya,');
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
