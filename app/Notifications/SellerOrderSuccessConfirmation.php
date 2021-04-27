<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SellerOrderSuccessConfirmation extends Notification implements ShouldQueue
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
                    ->markdown('emails.seller.success', ['order' => $this->order])
                    ->subject('Pesanan Selesai: "' . $this->order['products']['jasa_name'] . '"')
                    ->greeting('Hai ' . $this->order['products']['products']['seller']['name'] . ',')
                    ->line('Asikk pesanan dah selesai nih,')
                    ->line('Pendapatan akan otomatis masuk Exova Wallet bagian pendapatan ya, dan kamu bisa cairkan setelah 3 hari dari sekarang')
                    ->line('Di bawah ini detail pesanan dan pendapatan kamu ya')
                    ->action('Lihat Detail', url('/notifications/penjualan'));
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
