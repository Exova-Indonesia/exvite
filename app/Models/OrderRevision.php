<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRevision extends Model
{
    use HasFactory;
    protected $table = 'jasa_order_revision';
    protected $fillable = [
        'order_id',
        'path',
        'detail',
    ];
}
