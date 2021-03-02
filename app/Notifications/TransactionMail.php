<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionMail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // public $user;
    public $details;
    public function __construct($details)
    {
        // $this->user = $user;
        $this->details = $details;
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
        ->bcc('finance@exova.id')
        ->markdown('emails.transaction', ['details' => $this->details])
        ->subject('Rincian '. ucwords($this->details['wal_transaction_type']) . ' ' . ucwords($this->details['wal_reference_id']))
        ->greeting('Halo, ' . $this->details['debitedwallet']['walletusers']['name'])
        ->line('Berikut Kami lampirkan rincian ' . lcfirst($this->details['wal_transaction_type']) . ' kamu')
        ->attach(base_path('../assets' . '/' . $this->details['wal_invoice']));
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
