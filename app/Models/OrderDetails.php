<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $primaryKey = 'orders_detail_id';
    protected $table = 'orders_details';
    protected $fillable = [
        'orders_details_id',
        'order_id',
        'payment_id',
        'quantity',
        'unit_price',
        'subtotal'
    ];
}
