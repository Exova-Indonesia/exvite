<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserBirthdayGreetings extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
                    // ->markdown('emails.seller.success', ['order' => $this->order])
                    ->subject('Selamat ulang tahun ' . $this->user['name'])
                    ->greeting('Hi ' . $this->user['name'])
                    ->line('Ciee yang nambah umur, asikk malem ini party apa nichh')
                    ->line('Kami seluruh tim Exova Indonesia mengucapkan Selamat Ulang Tahun semoga apa yang diharapkan tercapai, semoga panjang umur dan sehat selalu');
                    // ->action('Lihat Detail', url('/notifications/penjualan'))
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
