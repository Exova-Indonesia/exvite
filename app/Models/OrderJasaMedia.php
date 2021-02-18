<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderJasaMedia extends Model
{
    use HasFactory;
    protected $table = 'jasa_orders_media';
    protected $fillable = [
        'jasa_order_media_id',
        'order_id',
        'example',
        'example_ori',
        'result',
        'revision',
    ];
}
