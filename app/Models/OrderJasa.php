<?php

namespace App\Models;

use App\Events\Ordered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderJasa extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'order_id';
    protected $table = 'jasa_orders';
    protected $fillable = [
        'order_id',
        'order_detail_id',
        'product_id',
        'customer_id',
        'type',
        'invoice',
        'status',
        'deadline',
        'batal_otomatis',
        'revision',
        'note',
        'deleted_at',

    ];
    protected $dates = ['deleted_at'];

    // protected $dispatchesEvents = [
    //     'created' => Ordered::class,
    // ];

    
    public function products() {
        return $this->belongsTo(Jasa::class, 'product_id');
    }
    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function details() {
        return $this->hasOne(OrderDetails::class, 'order_id');
    }
    public function success() {
        return $this->hasOne(OrderSuccess::class, 'order_id');
    }
    public function cancel() {
        return $this->hasOne(OrderCancel::class, 'order_id');
    }
}
