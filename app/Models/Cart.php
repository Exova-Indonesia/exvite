<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart_products';
    protected $fillable = [
        'cart_id',
        'user_id',
        'product_type',
        'quantity',
        'note',
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function jasa() {
        return $this->belongsTo(Jasa::class, 'product_id');
    }
}
