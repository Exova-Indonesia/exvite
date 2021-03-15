<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsOrder extends Model
{
    use HasFactory;
    protected $table = 'subs_orders';
    protected $fillable = [
        'order_id',
        'order_detail_id',
        'product_id',
        'customer_id',
        'type',
        'invoice',
    ];
}
