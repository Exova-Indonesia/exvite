<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartAdditional extends Model
{
    use HasFactory;
    protected $table = 'cart_additional';
    protected $fillable = [
        'cart_id',
        'additional_id',
        'quantity',
    ];

    public function additional() {
        return $this->belongsTo(JasaAdditional::class, 'additional_id');
    }
}
