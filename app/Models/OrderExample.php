<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderExample extends Model
{
    use HasFactory;
    protected $tabel = 'jasa_order_example';
    protected $fillable = [
        'order_id',
        'path',
    ];
}
