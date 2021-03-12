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
        'example',
    ];
    public function products() {
        return $this->belongsTo(Jasa::class, 'product_id');
    }
    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
