<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table = 'orders_details';
    protected $fillable = [
        'orders_details_id',
        'order_id',
        'quantity',
        'unit_price',
        'discount',
        'admin_fee',
        'total_price',
        'payment_type',
        'status',
    ];
}
