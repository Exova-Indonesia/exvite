<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetails extends Model
{
    use HasFactory;
    protected $table = 'cart_details';
    protected $fillable = [
        'cart_id',
        'notes',
        'example',
        'deadline',
    ];

    protected $casts = [
        'deadline',
    ];
}
