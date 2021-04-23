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
        'subtotal',
        'additional'
    ];

    public function additionals() {
        return $this->hasMany(OrderAdditional::class, 'orders_detail_id');
    }

    public function products() {
        return $this->belongsTo(OrderJasa::class, 'order_id');
    }

    public function payments() {
        return $this->belongsTo(PaymentDetail::class, 'payment_id');
    }
}
