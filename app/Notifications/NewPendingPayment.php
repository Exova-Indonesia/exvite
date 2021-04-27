<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPendingPayment extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $method;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->method = '';

        if($this->order['payment_method'] == 'gopay') {
            $this->method = 'Gopay/QRIS';
        } else if($this->order['payment_method'] == 'echannel') {
            $this->method = 'Mandiri Virtual Account';
        } else if($this->order['payment_method'] == 'bni_va') {
            $this->method = 'BNI Virtual Account';
        } else if($this->order['payment_method'] == 'permata_va') {
            $this->method = 'Permata Virtual Account';
        } else if($this->order['payment_method'] == 'bank_transfer') {
            $this->method = 'Bank Transfer';
        } else if($this->order['payment_method'] == 'exovawallet') {
            $this->method = 'Exova Wallet';
        }
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
                    ->markdown('emails.buyer.payments', ['order' => $this->order, 'method' => $this->method])
                    ->subject('Menunggu Pembayaran ' . $this->method)
                    ->greeting('Hai ' . $this->order['customer']['name'] . ',')
                    ->line('Pembayaran dengan ' . $this->method . ' menunggu nih! Yuk selesaikan pembayaranmu sekarang')
                    ->action('Bayar Sekarang', $this->order['path']);
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
