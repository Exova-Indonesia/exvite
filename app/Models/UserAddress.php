<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table = 'user_address';
    protected $fillable = [
        'address_id',
        'user_id',
        'address_name',
        'address',
        'state',
        'city',
        'postal',
        'country',
        'latitude',
        'longitude'
    ];
}
