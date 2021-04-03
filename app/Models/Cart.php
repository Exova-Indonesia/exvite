<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart_products';
    protected $primaryKey = 'cart_id';
    protected $fillable = [
        'cart_id',
        'user_id',
        'product_id',
        'product_type',
        'quantity',
        'note',
        'unit_price',
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function jasa() {
        return $this->belongsTo(Jasa::class, 'product_id');
    }
    public function plan() {
        return $this->belongsTo(Subscription::class, 'product_id');
    }
    public function details() {
        return $this->hasOne(CartDetails::class, 'cart_id');
    }
    public function additional() {
        return $this->hasMany(CartAdditional::class, 'cart_id');
    }
}
