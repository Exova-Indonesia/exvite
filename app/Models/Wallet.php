<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $table = 'wallets';
    protected $primaryKey = 'wallet_id';
    protected $fillable = [
        'wallet_id',
        'user_id',
    ];

    public function walletusers() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function transaction() {
        return $this->hasMany(Transaction::class, 'wal_debited_wallet');
    }
}
