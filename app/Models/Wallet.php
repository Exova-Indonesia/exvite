<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $table = 'wallets';
    protected $fillable = [
        'wallet_id',
        'user_id',
    ];

    public function walletusers() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
