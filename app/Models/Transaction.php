<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'wallet_transaction';
    protected $primaryKey = 'wal_transaction_id';
    protected $fillable = [
        'wal_transaction_id',
        'wal_reference_id',
        'wal_credited_wallet',
        'wal_debited_wallet',
        'wal_debited_bank',
        'wal_description',
        'wal_amount',
        'wal_transaction_type',
        'wal_status',
        'wal_token',
        'wal_invoice',
    ];
    public function creditedwallet() {
        return $this->belongsTo(Wallet::class, 'wal_debited_wallet');
    }
    public function debitedwallet() {
        return $this->belongsTo(Wallet::class, 'wal_credited_wallet');
    }
    public function withdraw() {
        return $this->belongsTo(Bank::class, 'wal_debited_bank');
    }
    public function snap() {
        return $this->hasOne(SnapTransaction::class, 'snap_transaction_id');
    }

    // public function routeNotificationForMail($notification)
    // {
    //     return $this->debitedwallet->walletusers->email;
    // }
}
