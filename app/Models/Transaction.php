<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'wallet_transaction';
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
    ];
}
