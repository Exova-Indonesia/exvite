<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnapTransaction extends Model
{
    use HasFactory;
    protected $table = 'snap_transaction';
    protected $fillable = [
        'snap_transaction_id',
        'snap_reference_id',
        'snap_credited_wallet',
        'snap_debited_wallet',
        'snap_debited_bank',
        'snap_description',
        'snap_amount',
        'snap_transaction_type',
        'snap_status',
        'snap_token',
    ];
}
