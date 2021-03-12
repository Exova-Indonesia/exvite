<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderJasaResult extends Model
{
    use HasFactory;
    protected $table = 'jasa_order_result';
    protected $fillable = [
        'order_id',
        'path',
    ];
}
