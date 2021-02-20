<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'user_address';
    protected $fillable = [
        'address',
        'address_name',
        'city',
        'state',
        'district',
        'postal',
    ];
}
