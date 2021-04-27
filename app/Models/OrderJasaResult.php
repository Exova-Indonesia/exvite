<?php

namespace App\Models;

use App\Events\OrderResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderJasaResult extends Model
{
    use HasFactory;
    protected $table = 'jasa_order_result';
    protected $fillable = [
        'order_id',
        'path',
    ];
    
    protected $dispatchesEvents = [
        'created' => OrderResult::class,
    ];
}
