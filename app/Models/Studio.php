<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;
    protected $fillable = [
        'prefix',
        'user_id',
        'name',
        'description',
        'address_id',
        'logo_id',
        'suspend',
    ];
}
