<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;
    protected $table = 'payment_details';
    protected $fillable = [
        'payment_id',
        'payment_method',
        'discount',
        'admin_fee',
        'amount',
        'status',
        'total',
    ];

    public function setTotal() {
        return $this->total = $this->amount + $this->admin_fee - $this->discount;
    }
}
