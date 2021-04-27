<?php

namespace App\Models;

use App\Events\Ordered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'payment_id';
    protected $table = 'payment_details';
    protected $fillable = [
        'payment_id',
        'payment_method',
        'customer_id',
        'path',
        'discount',
        'admin_fee',
        'amount',
        'status',
        'total',
        'invoice',
    ];

    protected $dispatchesEvents = [
        'saved' => Ordered::class,
    ];

    public function setTotal() {
        return $this->total = $this->amount + $this->admin_fee - $this->discount;
    }
    public function details() {
        return $this->hasMany(OrderDetails::class, 'payment_id');
    }
    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
