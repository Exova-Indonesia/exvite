<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderJasa extends Model
{
    use HasFactory;
    protected $table = 'jasa_orders';
    protected $fillable = [
        'order_id',
        'product_id',
        'customer_id',
        'type',
        'note',
        'invoice',
        'status',
        'deadline',
    ];
}
