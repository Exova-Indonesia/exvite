<?php

namespace App\Models;

use App\Events\OrderRequestRevision;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderRevision extends Model
{
    use HasFactory;
    protected $table = 'jasa_order_revision';
    protected $fillable = [
        'order_id',
        'detail',
    ];

    protected $dispatchesEvents = [
        'created' => OrderRequestRevision::class,
    ];
}
