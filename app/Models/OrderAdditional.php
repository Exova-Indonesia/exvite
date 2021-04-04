<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAdditional extends Model
{
    use HasFactory;
    protected $fillable = [
        'additional_id',
        'orders_detail_id',
        'price',
        'quantity',
        'title',
    ];

    public function additional() {
        return $this->belongsTo(JasaAdditional::class, 'additional_id');
    }
}
